<?php
require('model/frontend.php');

function listEpisodeFirst()
{
	$episode_first = getEpisodeFirst();
	require('view/frontend/indexView.php');
}

function listEpisodesLastThree()
{
    $episode_three = getEpisodesLastThree();
    require('view/frontend/indexView.php');
}

function listEpisodesAllId()
{
$episodes_published_id = getEpisodesPublishedId();
require('view/frontend/episodesView.php');
}

function countEpisodesPublished()
{
$reading_page = getEpisodesPublishedNumber();
require('view/frontend/episodesView.php');
}

function listEpisodes()
{
$nbepisode_all = getEpisodesPublishedAll();
require('view/frontend/episodesView.php');
}