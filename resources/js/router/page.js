export default (path) => {
    return () => import(`~/pages/${path}`).then(m => m.default || m)
}
