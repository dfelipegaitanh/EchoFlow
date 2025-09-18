# EchoFlow Environment Setup

EchoFlow integrates with Last.fm, Deezer, and Spotify to collect and display music listening data. This README documents the environment variables you need to configure before running the application.

## Quick Start

1. Duplicate the sample environment file and install dependencies:

   ```bash
   cp .env.example .env
   composer install
   npm install
   ```

2. Create the credentials described below.
3. Update `.env` with your keys and then run `php artisan config:clear` so Laravel picks up the new values.

> Keep private keys out of version control.

## Last.fm configuration

| Variable | Description |
| --- | --- |
| `LASTFM_API_KEY` | API key issued from your Last.fm developer account. |
| `LASTFM_USER` | Last.fm username whose listening data the app will fetch. |

How to obtain the credentials:

1. Log in or create an account at https://www.last.fm/.
2. Go to https://www.last.fm/api/account/create and register a new application.
3. Copy the API key and username into the `.env` file.

## Deezer configuration

| Variable | Description |
| --- | --- |
| `DEEZER_APP_ID` | Numeric identifier provided for your Deezer application. |
| `DEEZER_APP_NAME` | Display name you assign to the Deezer application. |
| `DEEZER_APP_KEY` | Secret key used to sign Deezer API requests. |
| `DEEZER_APP_DOMAIN` | Redirect domain you authorize in the Deezer developer console (often `http://localhost`). |

How to obtain the credentials:

1. Sign in at https://developers.deezer.com/ and open the Applications page.
2. Create a new application and supply the redirect domain you want to authorize.
3. Copy the app id, name, key, and redirect domain into the `.env` file.

## Spotify configuration

| Variable | Description |
| --- | --- |
| `SPOTIFY_KEY` | Spotify Client ID for your application. |
| `SPOTIFY_SECRET` | Spotify Client Secret paired with the client ID. |

How to obtain the credentials:

1. Sign in to the Spotify Developer Dashboard at https://developer.spotify.com/dashboard/.
2. Create a new app and accept the terms.
3. Copy the Client ID and Client Secret into the `.env` file.

## Example `.env` section

```env
LASTFM_API_KEY=your-lastfm-api-key
LASTFM_USER=your-lastfm-username

DEEZER_APP_ID=your-deezer-app-id
DEEZER_APP_NAME=EchoFlow
DEEZER_APP_KEY=your-deezer-app-key
DEEZER_APP_DOMAIN=http://localhost

SPOTIFY_KEY=your-spotify-client-id
SPOTIFY_SECRET=your-spotify-client-secret
```

After updating the variables run the relevant artisan commands or services that rely on these integrations to confirm everything is connected correctly.
