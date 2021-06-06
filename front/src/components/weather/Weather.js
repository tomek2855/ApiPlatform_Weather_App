import React from "react";
import './Weather.css';
import WeatherSidebar from "./WeatherSidebar";
import WeatherDetails from "./WeatherDetails";
import {useParams} from "react-router-dom";

function Weather() {
    const {cityId} = useParams();

    return (
        <div className="Weather">

            <div className="Weather-sidebar">
                <h5>Choose your city</h5>

                {WeatherSidebar()}
            </div>

            <div className="Weather-content">
                {WeatherDetails(cityId)}
            </div>

        </div>
    )
}

export default Weather;