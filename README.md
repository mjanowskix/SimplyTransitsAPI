# Transits tracking API

Simply tracking API which provides history of transits and distance calculating.

## Prerequirements
To run this application you have to make sure that you have `composer` and `PHP 7.*` installed.
You have to also provide `CONSUMER_KEY` from MapQuest.com

## Installation
1. Create `.env` file based on `.env-example`
2. Install dependencies `composer install`

## Run project
Run a project using php built-in server:
Navigate to `public` directory and run `php -S localhost:8000`

## Usage

### Get list of transits
`GET /transits`

### To add new transit and get distance
`POST /transits`
You have to send a body in a JSON format containing array of locations
`
{
	"locations": [
		"Štefana Moyzesa 1142, Zvolen, SK",
		"12 Place Jean Jaurès, 93100 Montreuil, FR"
		]
}
`
And you will get array of id, locations, distance and creation date


## References

https://developer.mapquest.com
