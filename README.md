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

	sample response:
		{
		  "total": 2,
		  "per_page": 15,
		  "current_page": 1,
		  "last_page": 1,
		  "next_page_url": null,
		  "prev_page_url": null,
		  "from": 1,
		  "to": 2,
		  "data": [
		    {
		      "id": 22,
		      "playlist_id": 11,
		      "priority": 22,
		      "youtube_url": "https://www.youtube.com/watch?v=ANO7pshrZ3s",
		      "title": "L.A. GUNS - Revolution (  Lyrics)",
		      "artist": "unknown",
		      "length": 208,
		      "filesize": 3135242
		    },
		    {
		      "id": 23,
		      "playlist_id": 11,
		      "priority": 23,
		      "youtube_url": "https://www.youtube.com/watch?v=rZOpDoeVWBg",
		      "title": "L.A. GUNS - Don't Look At Me That Way (  Lyrics)",
		      "artist": "unknown",
		      "length": 241,
		      "filesize": 3785359
		    }
		  ]
		}

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

	sample response:
		{
		  "id": 22,
		  "playlist_id": 11,
		  "priority": 22,
		  "youtube_url": "https://www.youtube.com/watch?v=ANO7pshrZ3s",
		  "title": "L.A. GUNS - Revolution (  Lyrics)",
		  "artist": "unknown",
		  "length": 208,
		  "filesize": 3135242
		}

Features to be added:
	Skipping tracks
	Reordering tracks
