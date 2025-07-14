export function useServiceLocator() {
  const staticServices: { [key: string]: string } = {
    users: 'http://localhost:8280'
  };

  return {
    get(serviceName: string): string {
      return staticServices[serviceName];
    },
    url(path: string): string {
      const [svc, endpoint] = path.split('.');
      return this.get(svc) + '/' + endpoint;
    }
  };
}
