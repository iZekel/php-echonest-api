<?php

require_once(dirname(__FILE__).'/EchoNestApiAbstract.php');

/**
 * Api calls for getting data about artists.
 *
 * @link      http://developer.echonest.com/docs/v4/artist.html
 * @author    Brent Shaffer <bshafs at gmail dot com>
 * @license   MIT License
 */
class EchoNestApiArtist extends EchoNestApiAbstract
{
  /**
   * Set the artist id.  The artist name OR the artist ID is required for many of the methods in this API
   *
   * @param   string  $id           the artist ID. An Echo Nest ID or a Rosetta Stone ID
   * @return  EchoNestApiArtist     the current object instance
   */
  public function setId($id)
  {
    return $this->setOption('id', $id);
  }
  
  /**
   * Set the artist name.  The artist name OR the artist ID is required for many of the methods in this API
   *
   * @param   string  $name         the artist name
   * @return  EchoNestApiArtist     the current object instance
   */
  public function setName($name)
  {
    return $this->setOption('name', $name);
  }

  /**
   * Get a list of audio documents found on the web related to an artist.
   * http://developer.echonest.com/docs/v4/artist.html#audio
   *
   * @param   integer $results        the number of results desired (0 < $results < 100)
   * @param   string  $start        the desired index of the first result returned
   * @return  array                 list of audio documents found
   */
  public function getAudio($results = 15, $start = 0)
  {
    $response = $this->getForArtist('artist/audio', array(
      'results' => $results,
      'start'   => $start,
    ));

    return $response['audio'];
  }
  
  /**
   * Get a list of artist biographies.
   * http://developer.echonest.com/docs/v4/artist.html#biographies
   *
   * @param   integer $results        the number of results desired (0 < $results < 100)
   * @param   string  $start          the desired index of the first result returned
   * @param   string|array $license   the desired licenses of the returned biographies
   * @return  array                   list of biographies found
   */
  public function getBiographies($results = 15, $start = 0, $license = null)
  {
    $response = $this->getForArtist('artist/biographies', array(
      'results' => $results,
      'start'   => $start,
      'license' => $license,
    ));

    return $response['biographies'];
  }

  /**
   * Get a list of blog articles related to an artist.
   * http://developer.echonest.com/docs/v4/artist.html#blogs
   *
   * @param   integer $results        the number of results desired (0 < $results < 100)
   * @param   string  $start          the desired index of the first result returned
   * @param   bool    $high_relevance if true only items that are highly relevant for this artist will be returned
   * @return  array                   list of blogs found
   */
  public function getBlogs($results = 15, $start = 0, $high_relevance = false)
  {
    $response = $this->getForArtist('artist/blogs', array(
      'results'        => $results,
      'start'          => $start,
      'high_relevance' => $high_relevance,
    ));

    return $response['blogs'];
  }
  
  /**
   * Get our numerical estimation of how familiar an artist currently is to the world.
   * http://developer.echonest.com/docs/v4/artist.html#familiarity
   *
   * @param   string  $id             the artist ID. An Echo Nest ID or a Rosetta Stone ID
   * @return  decimal
   */
  public function getFamiliarity()
  {
    $response = $this->getForArtist('artist/familiarity');

    return $response['familiarity'];
  }
  
  /**
   * Returns our numerical description of how hottt an artist currently is. Contact us at biz@echonest.com for information on how to obtain additional hotttnesss information, including historical hotttnesss data for each artist and a detailed breakdown of hotttnesss into editorial, social and mainstream categories.
   * http://developer.echonest.com/docs/v4/artist.html#hotttness
   *
   * @param   string  $type         controls the type of hotttnesss that is used (overall, social, reviews, mainstream)
   * @return  decimal
   */
  public function getHotttness($type = 'overall')
  {
    $response = $this->getForArtist('artist/hotttness', array(
      'type'          => $type,
    ));

    return $response['hotttnesss'];
  }
  
  /**
   * Get a list of artist images.
   * http://developer.echonest.com/docs/v4/artist.html#images
   *
   * @param   integer $results        the number of results desired (0 < $results < 100)
   * @param   string  $start          the desired index of the first result returned
   * @param   string|array $license   the desired licenses of the returned images
   * @return  array                   array of images found
   */
  public function getImages($results = 15, $start = 0, $license = null)
  {
    $response = $this->getForArtist('artist/images', array(
      'results' => $results,
      'start'   => $start,
      'license' => $license,
    ));

    return $response['images'];
  }
  
  /**
   * Get a list of news articles found on the web related to an artist.
   * http://developer.echonest.com/docs/v4/artist.html#news
   *
   * @param   integer $results        the number of results desired (0 < $results < 100)
   * @param   string  $start          the desired index of the first result returned
   * @param   bool    $high_relevance if true only news articles that are highly relevant for this artist will be returned
   * @return  array                   array of news articles found
   */
  public function getNews($results = 15, $start = 0, $high_relevance = false)
  {
    $response = $this->getForArtist('artist/news', array(
      'results'         => $results,
      'start'           => $start,
      'high_relevance'  => $high_relevance,
    ));

    return $response['news'];
  }
  
  /**
   * Get basic information on an artist: the name, the Echo Nest ID, and the MusicBrainz ID.
   * http://developer.echonest.com/docs/v4/artist.html#profile
   *
   * @param   string|array $bucket    indicates what data should be returned with each artist. possible values include: 
   *  - audio,
   *  - biographies
   *  - blogs
   *  - familiarity
   *  - hotttnesss
   *  - images
   *  - news
   *  - reviews
   *  - terms
   *  - urls
   *  - video
   *  - id:CA1234123412341234
   *  - id:musicbrainz
   *  - id:playme
   *  - id:7digital
   * @return  array                   array of information
   */
  public function getProfile($bucket = null)
  {
    $response = $this->getForArtist('artist/profile', array(
      'bucket'         => $bucket,
    ));

    return $response;
  }
  
  /**
   * Get reviews related to an artist's work.
   * http://developer.echonest.com/docs/v4/artist.html#reviews
   *
   * @param   integer $results        the number of results desired (0 < $results < 100)
   * @param   string  $start          the desired index of the first result returned
   * @return  array                   array of news articles found
   */
  public function getReviews($results = 15, $start = 0)
  {
    $response = $this->getForArtist('artist/reviews', array(
      'results'         => $results,
      'start'           => $start,
    ));

    return $response['reviews'];
  }
  
  /**
   * Search artists.
   * http://developer.echonest.com/docs/v4/artist.html#search
   * @param   array   $options          visit the documentation above to see all available options.  Some options include:
   * -  $bucket           audio, biographies, blogs, familiarity, hotttnesss, images, news, reviews, terms, urls, video, id:CA1234123412341234, id:musicbrainz, id:playme, or id:7digital	indicates what data should be returned with each artist
   * -  $limit            if true, limit the results to the given idspace or catalog
   * -  $name             the name of the artist to search for
   * -  $description      a description of the artist (alt-rock,-emo,harp^2)
   * -  $fuzzy_match      if true, a fuzzy search is performed
   * -  $max_familiarity  the maximum familiarity for returned artists (0.0 < familiarity < 1.0)
   * -  $min_familiarity  the minimum familiarity for returned artists (0.0 < familiarity < 1.0)
   * -  $max_hotttnesss   the maximum hotttnesss for returned artists (0.0 < hotttnesss < 1.0)
   * -  $min_hotttnesss   the minimum hotttnesss for returned artists (0.0 < hotttnesss < 1.0)
   * -  $sort             sort terms based upon weight or frequency (familiarity-asc, hotttnesss-asc, familiarity-desc, hotttnesss-desc)
   * @return  array                     array of search results
   */
  public function search($options = array())
  {
    $response = $this->api->get('artist/search', $options);

    return $response;
  }
  
  /**
   * Get a list of songs created by an artist.
   * http://developer.echonest.com/docs/v4/artist.html#songs
   *
   * @param   integer $results        the number of results desired (0 < $results < 100)
   * @param   string  $start          the desired index of the first result returned
   * @return  array                   array of news articles found
   */
  public function getSongs($results = 15, $start = 0)
  {
    $response = $this->getForArtist('artist/songs', array(
      'results'         => $results,
      'start'           => $start,
    ));

    return $response['songs'];
  }
  
  /**
   * Return similar artists given one or more artists for comparison. The Echo Nest provides up-to-the-minute artist similarity and recommendations from their real-time musical and cultural analysis of what people are saying across the Internet and what the music sounds like.
   * http://developer.echonest.com/docs/v4/artist.html#similar
   *
   * @param   integer $results            the number of results desired (0 < $results < 100)
   * @param   integer $min_results        Indicates the minimum number of results to be returned regardless of constraints (0 < $results < 100)
   * @param   integer $start              the desired index of the first result returned
   * @param   string|array $bucket        indicates what data should be returned with each artist
   * @param   decimal $max_familiarity    the maximum familiarity for returned artists (0.0 < familiarity < 1.0)
   * @param   decimal $min_familiarity    the minimum familiarity for returned artists (0.0 < familiarity < 1.0)
   * @param   decimal $max_hotttnesss     the maximum hotttnesss for returned artists (0.0 < hotttnesss < 1.0)
   * @param   decimal $min_hotttnesss     the minimum hotttnesss for returned artists (0.0 < hotttnesss < 1.0)
   * @param   bool    $reverse            if true, if true, return artists that are disimilar to the seeds
   * @param   bool    $limit              if true, limit the results to the given idspace or catalog
   * @param   string|array $seed_catalog  only give similars to those in a catalog or catalogs, An Echo Nest artist catalog identifier
   * @return  array                       array of similar artists found
   * @see     getProfile
   */
  public function getSimilar($results = 15, $min_results = 15, $start = 0, $bucket = null, 
    $max_familiarity = 1.0, $min_familiarity = 0.0, $max_hotttness = 1.0, $min_hotttness = 0.0,
    $reverse = false, $limit = false, $seed_catalog = null)
  {
    $response = $this->getForArtist('artist/similar', array(
      'results'         => $results,
      'start'           => $start,
    ));

    return $response['similar'];
  }
  
  /**
   * Get a list of most descriptive terms for an artist
   * http://developer.echonest.com/docs/v4/artist.html#terms
   *
   * @param   string  $sort          sort terms based upon weight or frequency (can be either "weight" or "frequency")
   * @return  array                  array of descriptive terms found
   */
  public function getTerms($sort = 'frequency')
  {
    $response = $this->getForArtist('artist/terms', array(
      'sort'         => $sort,
    ));

    return $response['terms'];
  }
  
  /**
   * Return a list of the top hottt artists.
   * http://developer.echonest.com/docs/v4/artist.html#top-hottt
   *
   * @param   integer $results        the number of results desired (0 < $results < 100)
   * @param   string  $start          the desired index of the first result returned
   * @param   string|array $bucket    indicates what data should be returned with each artist
   * @param   bool    $limit          if true artists will be limited to those that appear in the catalog specified by the id: bucket
   * @return  array                   array of top hottt found.  Data varies according to $bucket
   * @see     getProfile
   */
  public function getTopHottt($results = 15, $start = 0, $bucket = null, $limit = false)
  {
    $response = $this->api->get('artist/top_hottt', array(
      'results'         => $results,
      'start'           => $start,
      'bucket'          => $bucket,
      'limit'           => $limit,
    ));

    return $response;
  }
  
  /**
   * Returns a list of the overall top terms. Up to 1,000 terms can be returned.
   * http://developer.echonest.com/docs/v4/artist.html#top-terms
   *
   * @param   integer $results        the number of results desired (0 < $results < 1000)
   * @return  array                   array of top terms
   */
  public function getTopTerms($results = 15)
  {
    $response = $this->api->get('artist/top_hottt', array(
      'results'         => $results,
      'start'           => $start,
      'bucket'          => $bucket,
      'limit'           => $limit,
    ));

    return $response['terms'];
  }
  
  /**
   * Get links to the artist's official site, MusicBrainz site, MySpace site, Wikipedia article, Amazon list, and iTunes page.
   * http://developer.echonest.com/docs/v4/artist.html#urls
   *
   * @return  array                   array of urls for an artist
   */
  public function getUrls()
  {
    $response = $this->getForArtist('artist/urls');

    return $response['urls'];
  }
  
  /**
   * Get links to the artist's official site, MusicBrainz site, MySpace site, Wikipedia article, Amazon list, and iTunes page.
   * http://developer.echonest.com/docs/v4/artist.html#video
   *
   * @param   integer $results        the number of results desired (0 < $results < 100)
   * @param   string  $start          the desired index of the first result returned
   * @return  array                   array of urls for an artist
   */
  public function getVideo($results = 15, $start = 0)
  {
    $response = $this->getForArtist('artist/video', array(
      'results'         => $results,
      'start'           => $start,
    ));

    return $response['video'];
  }
  
  /**
   * Send a GET request for an artist.  
   * This is for when an id or name attribute are required
   */
  protected function getForArtist($path, array $parameters = array(), array $options = array())
  {
    if (!isset($parameters['id'], $parameters['name'])) {
      if ($id = $this->getOption('id')) {
        $parameters = array_merge(array('id' => $id), $parameters);
      }
      elseif ($name = $this->getOption('name')) {
        $parameters = array_merge(array('name' => $name), $parameters);
      }
      else {
        throw new Exception('This method requires an artist id or name.  Please set this using the setId() or setName() methods on the Artist API');
      }
    }
    
    return $this->api->get($path, $parameters, $options);
  }
}
