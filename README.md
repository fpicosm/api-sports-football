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

- **`get`** returns the information about the coaches and their careers. Examples:
  - `FootballApi::coaches()->get(['id' => 4])`
  - `FootballApi::coaches()->get(['search' => 'Guardiola'])`


- **`find`** returns the information about the coach and him/her career. Examples:
  - `FootballApi::coaches()->find(1)`
  - `FootballApi::coaches()->find(4)`


- **`trophies`** returns the trophies for a coach. Examples:
  - `FootballApi::coaches(1)->trophies()`
  - `FootballApi::coaches(4)->trophies()`

### Countries

- **`get`** returns the list of available countries for the "leagues" endpoint. Examples: 
  - `FootballApi::countries()->get()`
  - `FootballApi::countries()->get(['name' => 'England'])`
  - `FootballApi::countries()->get(['code' => 'GB'])`

### Fixtures

- **`get`** returns the list of fixtures. Examples:
  - `FootballApi::fixtures()->get(['live' => 'all'])`
  - `FootballApi::fixtures()->get(['league' => 39, 'season' => 2020])`


- **`find`** returns the fixture data. Examples: 
  - `FootballApi::fixtures()->find(592799)`


- **`findList`** returns the fixtures data. Examples:
  - `FootballApi::fixtures()->findList([592799, 592800])`


- **`events`** returns the events from a fixture. Examples:
  - `FootballApi::fixtures(592799)->events()`
  - `FootballApi::fixtures(592799)->events(['team' => 39])`
  - `FootballApi::fixtures(592799)->events(['type' => 'card'])`


- **`injuries`** returns the list of players not participating in the fixture. Examples: 
  - `FootballApi::fixtures(592799)->injuries()`
  - `FootballApi::fixtures(592799)->injuries(['team' => 39])`


- **`lineups`** returns the lineups for a fixture. Examples:
  - `FootballApi::fixtures(592799)->lineups()`
  - `FootballApi::fixtures(592799)->lineups(['team' => 39])`


- **`players`** returns the player's statistics from a fixture. Examples:
  - `FootballApi::fixtures(592799)->players()`
  - `FootballApi::fixtures(592799)->players(['team' => 39])`


- **`predictions`** returns predictions about a fixture. Examples: 
  - `FootballApi::fixtures(592799)->predictions()`


- **`statistics`** returns the statistics for one fixture. Examples: 
  - `FootballApi::fixtures(592799)->statistics()`
  - `FootballApi::fixtures(592799)->statistics(['team' => 39])`
  - `FootballApi::fixtures(592799)->statistics(['type' => 'Shots on goal'])`

### Leagues

- **`get`** returns the list of available competitions. Examples: 
  - `FootballApi::leagues()->get()`
  - `FootballApi::leagues()->get(['type' => 'league'])`
  - `FootballApi::leagues()->get(['country' => 'england'])`


- **`find`** returns the competition details. Examples: 
  - `FootballApi::leagues()->find(39)`
  - `FootballApi::leagues()->find(4)`


- **`seasons`** returns the list of available seasons. Examples: 
  - `FootballApi::leagues()->seasons()`


- **`fixtures`** returns the fixtures for a season. Examples: 
  - `FootballApi::leagues(39, 2020)->fixtures()`
  - `FootballApi::leagues(39, 2020)->fixtures(['team' => 39])`
  - `FootballApi::leagues(39, 2020)->fixtures(['live' => 'all'])`


- **`injuries`** returns the list of players not participating in the fixtures for a season. Examples: 
  - `FootballApi::leagues(39, 2020)->injuries()`
  - `FootballApi::leagues(39, 2020)->injuries(['team' => 39])`
  - `FootballApi::leagues(39, 2020)->injuries(['player' => 642])`


- **`players`** returns the players for a season (uses pagination, and receives the page number as first argument). Examples: 
  - `FootballApi::leagues(39, 2020)->players()`
  - `FootballApi::leagues(39, 2020)->players(20)`
  - `FootballApi::leagues(39, 2020)->players(1, ['team' => 39])`


- **`rounds`** returns the rounds for a season. Examples: 
  - `FootballApi::leagues(39, 2020)->rounds()`
  - `FootballApi::leagues(39, 2020)->rounds(['current' => 'true'])`


- **`standings`** returns the standings for a season. Examples: 
  - `FootballApi::leagues(39, 2020)->standings()`
  - `FootballApi::leagues(39, 2020)->standings(['team' => 39])`


- **`topAssists`** returns the best players in terms of assists for a season. Examples: 
  - `FootballApi::leagues(39, 2020)->topAssists()`


- **`topRedCards`** returns the players with the most red cards for a season. Examples:
  - `FootballApi::leagues(39, 2020)->topRedCards()`


- **`topScorers`** returns the best players in terms of goals scored for a season. Examples:
  - `FootballApi::leagues(39, 2020)->topScorers()`


- **`topYellowCards`** returns the players with the most yellow cards for a season. Examples: 
  - `FootballApi::leagues(39, 2020)->topYellowCards()`

### Players

- **`get`** returns the player's statistics. Examples: 
  - `FootballApi::players()->get($query)`.


- **`seasons`** returns all available seasons for a given player. Examples: 
  - `FootballApi::players(29)->seasons()`


- **`sidelined`** returns all available sidelined for a player. Examples: 
  - `FootballApi::players(29)->sidelined()`


- **`squads`** returns the set of teams associated with the player. Examples: 
  - `FootballApi::players(29)->squads()`
  - `FootballApi::players(29)->squads(['team' => 530])`


- **`statistics`** returns the player statistics for a given season. Examples:
  - `FootballApi::players(29)->statistics(2021)`
  - `FootballApi::players(29)->statistics(2021, ['league' => 2])`

  
- **`transfers`** returns all available transfers for a player. Examples: 
  - `FootballApi::players(29)->transfers()`
  - `FootballApi::players(29)->transfers(['team' => 530])`


- **`trophies`** returns all available trophies for a player. Examples: 
  - `FootballApi::players(29)->trophies()`

### Teams

- **`get`** returns the list of available teams. Examples: 
  - `FootballApi::teams()->get(['league' => 39, 'season' => 2020])` 
  - `FootballApi::teams()->get(['country' => 'england'])`


- **`find`** returns the team information. Examples: 
  - `FootballApi::teams()->find(33)`
  - `FootballApi::teams()->find(530)`


- **`countries`** returns the list of countries available for the "teams" endpoint. Examples: 
  - `FootballApi::teams()->countries()`.


- **`h2h`** returns head to head between two teams. Examples: 
  - `FootballApi::teams(33)->h2h(530)`
  - `FootballApi::teams(33)->h2h(530, ['league' => 2, 'season' => 2021])`


- **`seasons`** returns the list of seasons available for a team. Examples:
  - `FootballApi::teams(33)->seasons()`


- **`squad`** returns the current squad of a team. Examples: 
  - `FootballApi::teams(33)->squad()`
  - `FootballApi::teams(33)->squad(['player' => 882])`


- **`standings`** returns the standings for a team given the year. Examples: 
  - `FootballApi::teams(33)->standings(2021)`
  - `FootballApi::teams(33)->standings(2021, ['league' => 2])`

  
- **`statistics`** returns the statistics of a team in relation to a given competition and season. Examples: 
  - `FootballApi::teams(33)->statistics(2, 2021)`
  - `FootballApi::teams(33)->statistics(39, 2021, ['date' => '2021-12-31'])`


- **`transfers`** returns all available transfers for a team. Example:
  - `FootballApi::teams(33)->transfers()`
  - `FootballApi::teams(33)->transfers(['player' => 5982])`


### Timezones

- **`get`** returns the list of available timezone to be used in the "fixtures" endpoint. Examples: 
  - `FootballApi::timezones()->get()`.


### Venues

- **`get`** returns the list of available venues. Examples: 
  - `FootballApi::venues()->get(['city' => 'london'])`
  - `FootballApi::venues()->get(['country' => 'england'])`


- **`find`** returns the venue information. Examples: 
  - `FootballApi::venues()->find(489)`


In this way, you can instantiate an item and combine different calls. For example:

```php
$fixture = FootballApi::fixtures(592799);
$fixture->lineups(); // is the same as FootballApi::fixtures(592799)->lineups();
$fixture->events(); // is the same as FootballApi::fixtures(592799)->events();
```