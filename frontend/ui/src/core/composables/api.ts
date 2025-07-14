import {useAuth} from "./auth";
import {ref} from "vue";

function replaceUndefined(obj: any) {
  return Object.fromEntries(
    Object.entries(obj).map(([key, value]) =>
      [key, value === undefined ? '' : value]
    )
  );
}

export function useApi() {
  const {addAuthHeaders} = useAuth();

  const headers: HeadersInit = {
    'Content-Type': 'application/json',
  };
  addAuthHeaders(headers)

  return {
    /**
     * Make post request
     * @param resource
     * @param data
     */
    async post(resource: string, data?: any) {
      const result = ref(null);
      const error = ref<string | null>(null);

      try {
        return  await fetch(resource, {
          method: 'POST',
          headers: {'Content-Type': 'application/json'},
          body: JSON.stringify(replaceUndefined(data)),
        })
      } catch (e: any) {
        error.value = e.message
      }
    },
  }
}
