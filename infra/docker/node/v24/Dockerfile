# Используем нужную версию Node (например, 20 или 24)
FROM node:24

# Создаём директорию внутри контейнера
WORKDIR /app

# Копируем package.json и устанавливаем зависимости
COPY package*.json ./
RUN npm install

# Копируем весь остальной код
COPY . .

# Экспонируем порт (тот, что указан в webpack.config.js)
EXPOSE 9000

# Команда по умолчанию
CMD ["npm", "start"]
