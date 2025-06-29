import {useApi} from "./api.ts";
import {useServiceLocator} from "./serviceLocator.ts";
const api = useApi();
const serviceLocator = useServiceLocator();

export function useClient () {

  return {
    get (path: string): string {
      return staticServices[serviceName];
    },

    /**
     * Make post request
     * @param path
     * @param data
     */
    post (path: string, data: any) {
      return api.post(
        serviceLocator.url(path),
        data,
      )
    }
  }
}
