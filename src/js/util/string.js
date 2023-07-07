const objectToQueryString = (obj) => {
  if (!Object.keys(obj).length) return "";

  return Object.keys(obj)
    .filter((key) => obj[key] != "")
    .map((key) => {
      const valStr = obj[key].join(",");
      return `${key}=${valStr}`;
    })
    .join("&");
};

const queryStringToObject = (str, valueDelimeter=',') => {
    if (!str) return {};

    const urlParams = new URLSearchParams(str);
    const entries = urlParams.entries();
    const result = {}

    for(const [key, value] of entries) { // each 'entry' is a [key, value] tupple
      result[key] = value.split(valueDelimeter);
    }

    return result;
}

export { objectToQueryString, queryStringToObject };
