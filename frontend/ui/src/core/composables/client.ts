import {useApi} from "./api.ts";
import {useServiceLocator} from "./serviceLocator.ts";
const api = useApi();
const serviceLocator = useServiceLocator();

export function useClient () {

  return {
    get (path: string): string {
      return 'ok';
    },

    /**
     * Make post request
     * @param path
     * @param data
     */
    async post (path: string, data: any) {
      return await api.post(
        serviceLocator.url(path),
        data,
      )
    }
  }
}
