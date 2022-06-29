# Football Api

This project is a wrapper for Laravel/Lumen for the [Api Football](https://www.api-football.com/) calls. You can see the documentation [here](https://api-sports.io/documentation/football/v3)

## 1. Installation

Require the package via `composer` in your `composer.json`.
```json
{
  "require": {
    "fpicosm/api-sports-football": "^1.0"
  }
}
```
  
Run `composer` to install or update the new requirement.

```bash
$ composer install
```

or

```bash
$ composer update
```

## 2. Configuration

First, you need to update your `.env` file adding three variables:

- **FOOTBALL_API_ORIGIN**: Set the origin where you obtained your api key. Values accepted: `rapidapi` or `api-sports`. See the [documentation](https://api-sports.io/documentation/football/v3#section/Authentication) for more details. 
- **FOOTBALL_API_KEY**: Set your api key obtained in the previous step.
- **FOOTBALL_API_TIMEZONE**: Set the timezone (optional, if you leave empty, the api will get the value from `env('APP_TIMEZONE')`). The value needs to exist in the [Timezone endpoint](https://api-sports.io/documentation/football/v3#tag/Timezone/operation/get-timezone)

Then, you need to add the providers and facades:

### Using Laravel

**1.** Register the ServiceProvider in `config/app.php` in the `providers` section:

```bash
ApiSports\FootballApi\FootballApiServiceProvider::class,
```

**2.** Add the Facade alias in `config/app.php` in the `aliases` section:

```bash
'FootballApi' => ApiSports\FootballApi\Facades\FootballApi::class,
```

**3.** Publish the config file
```bash
php artisan vendor:publish --provider="ApiSports\FootballApi\FootballApiServiceProvider"
```

### Using Lumen

**1.** Create the folder `config` at the root of the project

**2.** Create the file `config/config_path.php` and paste inside:

```php
<?php

if (!function_exists('config_path')) {
    /**
     * Get the configuration path.
     *
     * @param string $path
     * @return string
     */
    function config_path($path = '')
    {
        return app()->basePath() . '/config' . ($path ? '/' . $path : $path);
    }
}
```

**3.** Create the file `config/football-api.php` and paste inside:

```php
<?php

return [
    'base_url' => env('FOOTBALL_API_BASE_URL'),
    'api_key' => env('FOOTBALL_API_KEY'),
    'timezone' => env('APP_TIMEZONE')
];
```

**4.** Add the config files in `bootstrap/app.php` in the `Register Config Files` section:

```bash
$app->configure('config_path');
$app->configure('football-api');
```

**5.** Add the ServiceProvider in `bootstrap/app.php` in the `Register Service Providers` section:

```bash
$app->register(ApiSports\FootballApi\FootballApiServiceProvider::class);
```

**6.** Create the Facade alias at the end of `bootstrap/app.php`, just before the `return $app;`:

```bash
class_alias(\ApiSports\FootballApi\Facades\FootballApi::class, 'FootballApi');
```

**7.** Uncomment the line `$app->withFacades();` in `bootstrap/app.php`

## 3. Usage

You can call to `FootballApi::class()->method()`. The available classes and methods are:

### Coaches

- `get` returns the information about the coaches and their careers: `FootballApi::coaches()->get($query)`.
- `find` returns the information about the coach and him/her career: `FootballApi::coaches()->find($id)`. Is equivalent to `FootballApi::coaches()->get(['id' => $id])->response[0]`.


- `trophies` returns the trophies for a coach: `FootballApi::coaches($id)->trophies($query)`.

### Countries

- `get` returns the list of available countries for the "leagues" endpoint: `FootballApi::countries()->get($query)`.

### Fixtures

- `get` returns the list of fixtures: `FootballApi::fixtures()->get($query)`.
- `find` returns the fixture data: `FootballApi::fixtures()->find($id)`. Is equivalent to `FootballApi::fixtures()->get(['id' => $id])->response[0]`.


- `events` returns the events from a fixture: `FootballApi::fixtures($id)->events($query)`.
- `injuries` returns the list of players not participating in the fixture: `FootballApi::fixtures($id)->injuries($query)`.
- `lineups` returns the lineups for a fixture: `FootballApi::fixtures($id)->lineups($query)`.
- `players` returns the player's statistics from one fixture: `FootballApi::fixtures($id)->players($query)`.
- `predictions` returns predictions about a fixture: `FootballApi::fixtures($id)->predictions()`.
- `statistics` returns the statistics for one fixture: `FootballApi::fixtures($id)->statistics($query)`.

### Leagues

- `get` returns the list of available competitions: `FootballApi::leagues()->get()`.
- `find` returns the competition details: `FootballApi::leagues()->find($id)`. Is equivalent to `FootballApi::leagues()->get(['id' => $id])->response[0]`.
- `seasons` returns the list of available seasons: `FootballApi::leagues()->seasons()`.


- `fixtures` returns the fixtures for a season: `FootballApi::leagues($id, $year)->fixtures($query)`.
- `injuries` returns the injuries for a season: `FootballApi::leagues($id, $year)->injuries($query)`.
- `players` returns the players for a season: `FootballApi::leagues($id, $year)->players($page, $query)`.
- `rounds` returns the rounds for a season: `FootballApi::leagues($id, $year)->rounds($query)`.
- `standings` returns the standings for a season: `FootballApi::leagues($id, $year)->standings($query)`.
- `topAssists` returns the best players in terms of assists for a season: `FootballApi::leagues($id, $year)->topScorers()`.
- `topRedCards` returns the players with the most red cards for a season: `FootballApi::leagues($id, $year)->topScorers()`.
- `topScorers` returns the best players in terms of goals scored for a season: `FootballApi::leagues($id, $year)->topScorers()`.
- `topYellowCards` returns the players with the most yellow cards for a season: `FootballApi::leagues($id, $year)->topScorers()`.

### Players

- `get` returns the player's statistics: `FootballApi::players()->get($query)`.


- `seasons` returns all available seasons for a given player: `FootballApi::players($id)->seasons()`.
- `sidelined` returns the set of teams associated with the player: `FootballApi::players($id)->squads($query)`.
- `squads` returns the set of teams associated with the player: `FootballApi::players($id)->squads($query)`.
- `statistics` returns the player statistics for a given season: `FootballApi::players($id)->statistics($year, $query)`.
- `transfers` returns the set of teams associated with the player: `FootballApi::players($id)->squads($query)`.
- `trophies` returns the set of teams associated with the player: `FootballApi::players($id)->squads($query)`.

### Teams

- `get` returns the list of available teams: `FootballApi::teams()->get($query)`.
- `find` returns the team information: `FootballApi::teams()->find($id)`. Is equivalent to `FootballApi::teams()->get(['id' => $id])->response[0]`.


- `countries` returns the list of countries available for the "teams" endpoint: `FootballApi::teams()->countries()`.


- `h2h` returns head to head between two teams: `FootballApi::teams($id)->h2h($opponentId, $query)`.
- `seasons` returns the list of seasons available for a team: `FootballApi::teams($id)->seasons()`
- `squad` returns the current squad of a team: `FootballApi::teams($id)->squad($query)`.
- `standings` returns the standings for a team given the season: `FootballApi::teams($id)->standings($season, $query)`.
- `statistics` returns the statistics of a team in relation to a given competition and season: `FootballApi::teams($id)->statistics($leagueId, $season, $query)`.
- `transfers` returns all available transfers for a team: `FootballApi::teams($id)->transfers($query)`.

### Timezones

- `get` returns the list of available timezone to be used in the "fixtures" endpoint: `FootballApi::timezones()->get()`.

### Venues

- `get` returns the list of available venues: `FootballApi::venues()->get($query)`.
- `find` returns the venue information: `FootballApi::venues()->find($id)`. Is equivalent to `FootballApi::venues()->get(['id' => $id])->response[0]`.
