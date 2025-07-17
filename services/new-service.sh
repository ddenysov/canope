#!/usr/bin/env bash
set -euo pipefail

SRC="user-service"
DST="template"

# 0. Проверка
if [ -e "$DST" ]; then
  echo "Directory '$DST' already exists. Remove it first or choose another name." >&2
  exit 1
fi

# 1. Копирование (исключаем src/var и src/vendor)
rsync -a \
  --exclude='var' \
  --exclude='vendor' \
  "$SRC"/ "$DST"/

# 2. Подготовка in-place опции для perl (GNU и BSD одинаково понимают -i'')
PERL_INPLACE=(-i'')

# 3. Замена содержимого файлов.  \0 показывает perl весь файл сразу (-0777)
grep -RlZ --binary-files=without-match -e '[Uu][Ss][Ee][Rr]' "$DST" \
| xargs -0 perl -0777 "${PERL_INPLACE[@]}" -pe '
  sub map_case {
    my ($old, $new) = @_;
    return uc($new)                 if $old eq uc($old);          # USER
    return ucfirst($new)            if $old =~ /^[A-Z][a-z]+$/;   # User
    return lc($new);                                               # user или смешанный
  }
  s/(user)/map_case($1, "template")/eig
'

# 4. Переименование файлов и папок
find "$DST" -depth -iname '*user*' -print0 | while IFS= read -r -d '' old; do
  new=$(perl -e '
    my $p = shift;
    sub map_case {
      my ($old, $new) = @_;
      return uc($new)                 if $old eq uc($old);
      return ucfirst($new)            if $old =~ /^[A-Z][a-z]+$/;
      return lc($new);
    }
    $p =~ s/(user)/map_case($1, "template")/eig;
    print $p;
  ' "$old")
  [ "$old" != "$new" ] && mv "$old" "$new"
done

echo "Success: '$DST' ready."
