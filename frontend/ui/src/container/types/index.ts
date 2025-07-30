import type {Responsive} from "@/core/types/core/responsive.ts";

export type ContainerLayout = 'default' | 'center' | 'x-center' | 'y-center';

export interface UiContainerProps {
  layout?: ContainerLayout | Responsive<ContainerLayout>
}
