import actionsEnv from "../actionsEnv";

export function getCities() {
    return fetch(actionsEnv.baseUrl + "cities")
        .then(res => res.json())
        .then(json => json["hydra:member"]);
}

export function getCity(id) {
    return fetch(actionsEnv.baseUrl + "cities/" + id)
        .then(res => res.json());
}
