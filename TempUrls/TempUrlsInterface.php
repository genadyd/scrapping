<?php


namespace TempUrls;
/*
 * Urls object
 * vsrs:
 *  res_urls_array:private, assoc array
 *
 * methods:
 *  @ public ResPush : void -- set new value into "res_urls_array"
 *  @ public GetResArray : array --  get and retrieve "res_urls_array"
 *  @ private CheckIsUniq : boolean -- check if url not exists in "res_urls_array"
 * */

interface TempUrlsInterface
{
function TempResPush($val);
function TempGetResArray();
}
