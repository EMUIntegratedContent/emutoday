<?= '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL ?>
<rss version="2.0" xmlns:atom="https://www.w3.org/2005/Atom" xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:webfeeds="http://webfeeds.org/rss/1.0" xmlns:media="http://search.yahoo.com/mrss/">
    <channel>
        <title><![CDATA[ EMU Today - News ]]></title>
        <link><![CDATA[ {{ env('APP_URL') }}/feed/news ]]></link>
        <description><![CDATA[ Current news and stories from EMU Today ]]></description>
        <language>en</language>
        <pubDate>{{ now() }}</pubDate>

        @foreach($items as $item)
            <item>
                <title><![CDATA[{!! $item->title !!}]]></title>
                <link>{{ URL::to('/story/'.$item->story_type.'/'.$item->id) }}</link>
                <content:encoded><![CDATA[{!! $item->content !!}]]></content:encoded>
                <category><![CDATA[{{ $item->story_type }}]]></category>
                <author><![CDATA[{{ $item->author ? $item->author['first_name'].' '.$item->author['last_name'] : ''}}]]></author>
                <guid>{{ URL::to('/story/'.$item->story_type.'/'.$item->id) }}</guid>
                <pubDate>{{ $item->start_date }}</pubDate>
            </item>
        @endforeach
    </channel>
</rss>