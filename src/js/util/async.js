const getFetchOptions = (body, method) => {
    const fetchOptions = {
        mode: "cors",
        cache: "no-cache",
        method: method,
        headers: {
            Accept: "application/json, text/plain, */*;"
        }
    };

    if (method === "POST" && typeof body === "object" && Object.keys(body).length > 0) {
        fetchOptions.body = JSON.stringify(body);
    }

    return fetchOptions;
};

const fetchRest = (path, body = {}, method = "GET") => {
    const encodedPath = path
        .split("/")
        .map((part) => encodeURIComponent(part))
        .join("/");
    
    let qryStr = '';
    if (typeof body === "object" && Object.keys(body).length > 0 && method === "GET") {
        qryStr = '?'+jQuery.param(body);
    }

    return fetch(
        `${encodeURI(window.rest_object.api_url)}${encodedPath}${qryStr}`,
        getFetchOptions(body, method)
    )
        .then((data) => data.json())
        .then((data) => {
            return data;
        })
        .catch((err) => console.log("DEBUG: was not able to be fetched", err));
};

export default fetchRest;
