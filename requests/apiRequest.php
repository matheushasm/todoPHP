<?php

require_once './requests/apiObject.php';


// QUOTES API REQUEST
$quoteOpt = new Options();
$quoteOpt->setUrl('https://quotes15.p.rapidapi.com/quotes/random/');
$quoteOpt->setMethod('GET');
$quoteOpt->setHeaders([
    "X-RapidAPI-Host: quotes15.p.rapidapi.com",
    "X-RapidAPI-Key: 4f04132018msh45653bb27f48864p1efed2jsn176cff22d1ac"
]);
$quoteRequest = new Request($quoteOpt);
$quote = $quoteRequest->newRequest();

// BACKGROUND IMAGE API REQUEST
$backgroundOpt = new Options();
$backgroundOpt->setUrl('https://api.pexels.com/v1/search?query=nature');
$backgroundOpt->setMethod('GET');
$backgroundOpt->setHeaders([
    "Accept: application/json",
    "Content-Type: application/json",
    "Authorization: 563492ad6f917000010000015f64f1588c31454d92826c04d7062525"
]);
$backgroundReq = new Request($backgroundOpt);
$backgroundRes = $backgroundReq->newRequest()->photos;
$bgImage = $backgroundReq->newRequest()->photos[rand(0, count($backgroundRes))]->src->original;