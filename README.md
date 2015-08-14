# OpenPlugServer

API Documentation:


Creating playlists:
	route:
		{host}/playlists

	action:
		post

	parameters:
		playlist_name -> "some string"


Getting the current song from playlist:
Current song field refers to a song id.
	route:
		{host}/playlists/{playlist name}

	action:
		get

	parameters:
		none

Getting all songs in playlist:
	route:
		{host}/playlists/{playlist name}/songs

	action:
		get

	parameters:
		page -> page of results to get
		limit -> number of results to return per page, default 15, max 150


Add song to playlist:
	route:
		{host}/playlists/{playlist name}/songs

	action:
		post

	parameters:
		youtube_url -> full youtube link
		title -> track title
		artist -> band name
		length -> in seconds

Get Song information from playlist:
	route:
		{host}/playlists/{playlist name}/songs/{song id}

	action:
		get

	parameters:
		none

Features to be added:
	Skipping tracks
	Reordering tracks
