import type {Responsive} from "@/core/types/core/responsive.ts";
import type {Color, Tint} from "@/core/types/core/theme.ts";

export const  useClass = <T>(props: string, value: string | number | undefined | Responsive<T>) => {
    if (value === undefined) {
        return {};
    }

    if (typeof value === 'object') {
        return Object.entries(value).map((entry) => {
            return entry[1] === '' ? { [`${entry[0]}:${props}`]: true } : { [`${entry[0]}:${props}-${entry[1]}`]: true };
        })

    }

    return value === '' ? { [`${props}`]: true } : { [`${props}-${value}`]: true };
}

export const  useBooleanClass = (props: string, value: boolean | undefined) => {
    if (value === undefined) {
        return {};
    }

    return { [`${props}`]: value };
}

export const  useColorStyle = (color: Color, tint: Tint  ) => {
    const hex: number = tint > 500 ? 255 : 0;

    return `background-color: var(--${color}-${tint}); color: rgb(${hex}, ${hex}, ${hex});`;
}
