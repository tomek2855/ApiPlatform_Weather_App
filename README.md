# Simple Weather Application based on Api Platform

### Live app
http://weather.toadres.pl/

#### How to run backend server
- Go to `./backend` folder
- Rename `.env.example` to `.env`
- Fill `.env` file with database and OpenWeatherMap credentials
- Run `composer install`
- Run `php bin/console doctrine:migrations:migrate`
- Run `php -S 127.0.0.1:8000 -t public`

To download fresh weather data run `php bin/console app:get-weather`

#### How to run admin panel
- Go to `./admin` folder
- Run `yarn install`
- Run `yarn start`
- Change API url if required in `./src/App.js` file

To add city to list go to `http://localhost:3000`

#### How to run frontend
- Go to `./front` folder
- Run `yarn install`
- Run `yarn start`
- Change API url if required in `./src/actions/actionsEnv.js` file
