<link href="https://fonts.googleapis.com/css?family=Poppins:400,400i,500,600,700" rel="stylesheet">

<style type="text/css" media="screen">

}
/*Media Queries*/
@media screen and (max-width: 400px) {

}
@media screen and (min-width: 401px) and (max-width: 620px) {

}
</style>

@foreach($upcomingStories as $story)
  {{ $story->title }}
@endforeach
