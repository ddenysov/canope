export function useServiceLocator () {
  const staticServices = {
    users: 'http://localhost:8280'
  }

  return {
    get (serviceName: string): string {
      return staticServices[serviceName];
    },

    url (path: string): string {
      const parts = path.split('.');

      return this.get(parts[0]) + '/' + parts[1];
    }
  }
}
