import {useAuth} from "./auth";
import {ref} from "vue";

function replaceUndefined(obj) {
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
     * Get
     * @param resource
     */
    async get(resource: string) {
      const res: any = await $fetch(
        resource,
        {
          method: 'GET',
          headers,
        },
      );

      return res;
    },

    /**
     * Make post request
     * @param resource
     * @param data
     */
    async post(resource: string, data?: any) {
      const result = ref(null);
      const error = ref<string | null>(null);

      try {
        const res = await fetch(resource, {
          method: 'POST',
          headers: {'Content-Type': 'application/json'},
          body: JSON.stringify(replaceUndefined(data)),
        })
        if (!res.ok) throw new Error(res.statusText)
        result.value = await res.json()
      } catch (e: any) {
        error.value = e.message
      }
    },
  }
}
