import React, {useEffect, useState} from "react";
import {getCity} from "../../actions/weather/cities";
import {getCityWeather} from "../../actions/weather/weather";
import Chart from "react-google-charts";

function WeatherDetails(cityId) {
    const [city, setCity] = useState({});
    const [weather, setWeather] = useState([]);
    const [lastRecord, setLastRecord] = useState(null);
    const [chartData, setChartData] = useState([[{type: 'datetime', label: 'Day'}, 'Temperature', 'Humidity']]);
    const [chartData2, setChartData2] = useState([[{type: 'datetime', label: 'Day'}, 'Pressure']]);

    useEffect(() => {
        if (cityId) {
            getCity(cityId)
                .then(data => setCity(data));

            getCityWeather(cityId)
                .then(data => setWeather(data));
        }
    }, [cityId]);

    useEffect(() => {
        setLastRecord(weather.length > 0 && weather[weather.length - 1]);

        setChartData([[{
            type: 'datetime',
            label: 'Day'
        }, 'Temperature', 'Humidity']].concat(weather.slice(-24).map(item => {
            return [new Date(item.createdAt), parseInt(item.temp - 273.15), item.humidity];
        })));

        setChartData2([[{
            type: 'datetime',
            label: 'Day'
        }, 'Pressure']].concat(weather.slice(-24).map(item => {
            return [new Date(item.createdAt), item.preesure];
        })));
    }, [weather]);

    return cityId && (
        <div>
            <h5>{city.name} weather details</h5>
            <hr/>

            <div>
                <h6>Latest weather data</h6>

                {lastRecord &&
                <div className="table-responsive">
                    <table className="table table-bordered table-sm">
                        <thead className="thead-dark">
                        <tr>
                            <th>Timestamp</th>
                            <th>Temperature</th>
                            <th>Temperature feels like</th>
                            <th>Pressure</th>
                            <th>Humidity</th>
                            <th>Wind direction</th>
                            <th>Wind speed</th>
                            <th>Visibility</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{(new Date(lastRecord.createdAt)).toString()}</td>
                            <td>{parseInt(lastRecord.temp - 273.15)}°C</td>
                            <td>{parseInt(lastRecord.tempFeelsLike - 273.15)}°C</td>
                            <td>{lastRecord.preesure}hPa</td>
                            <td>{lastRecord.humidity}%</td>
                            <td>{lastRecord.windDeg}°</td>
                            <td>{lastRecord.windSpeed}m/s</td>
                            <td>{lastRecord.visibility}m</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                }
            </div>

            <div>
                <h6>Latest weather reads</h6>

                <div>
                    <div style={{display: 'flex', maxWidth: 900, overflowX: 'auto', overflowY: 'hidden'}}>
                        <Chart
                            width={600}
                            height={300}
                            chartType="LineChart"
                            loader={<div>Loading Chart</div>}
                            data={chartData}
                            legendToggle
                        />
                    </div>

                    <div style={{display: 'flex', maxWidth: 900, overflowX: 'auto', overflowY: 'hidden'}}>
                        <Chart
                            width={600}
                            height={300}
                            chartType="LineChart"
                            loader={<div>Loading Chart</div>}
                            data={chartData2}
                            legendToggle
                            series={{
                                1: {curveType: 'function'}
                            }}
                        />
                    </div>
                </div>
            </div>
        </div>
    );
}

export default WeatherDetails;