import actionsEnv from "../actionsEnv";

export function getCityWeather(cityId) {
    return fetch(actionsEnv.baseUrl + "cities/" + cityId + "/weather_records")
        .then(res => res.json());
}