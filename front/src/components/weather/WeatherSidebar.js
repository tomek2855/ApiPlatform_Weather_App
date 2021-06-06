import React, {useEffect, useState} from "react";
import {getCities} from "../../actions/weather/cities";
import {Link} from "react-router-dom";

function WeatherSidebar() {
    const [cities, setCities] = useState([]);

    useEffect(() => {
        getCities()
            .then(data => setCities(data));
    }, []);

    return (
        <div className="card">
            <ul className="list-group list-group-flush">
                {cities && cities.map((city, index) => {
                    const cityUrl = "/weather/" + city.id;

                    return (
                        <li className="list-group-item" key={index}>
                            <Link to={cityUrl} className="Weather-sidebar-Link">{city.name}</Link>
                        </li>
                    );
                })}
            </ul>
        </div>
    );
}

export default WeatherSidebar;