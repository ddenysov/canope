import type {Responsive} from "@/core/types/core/responsive.ts";

export type AlignItems = 'stretch' | 'start' | 'center' | 'baseline' | 'end';
export type JustifyContent = 'between' | 'start' | 'center' | 'around' | 'end' | 'evenly';
export type Bit = '0' | '1';
export type Gap = 1 | 2 | 3 | 4 | 5 | 6 | 7 | 8;
export type Direction = 'row' | 'column';

export interface UiFlexProps {
  grow?: Bit | Responsive<Bit>
  shrink?: Bit | Responsive<Bit>
  alignItems?: AlignItems | Responsive<AlignItems>
  justifyContent?: JustifyContent | Responsive<JustifyContent>
  direction?: Direction | Responsive<Direction>
  gap?: number | Responsive<Gap>
  fullHeight?: boolean,
}
