<?= '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL ?>
<rss version="2.0" xmlns:atom="https://www.w3.org/2005/Atom" xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:webfeeds="http://webfeeds.org/rss/1.0" xmlns:media="http://search.yahoo.com/mrss/">
    <channel>
        <title><![CDATA[ EMU Today - Events ]]></title>
        <link><![CDATA[ {{ env('APP_URL') }}/feed/events ]]></link>
        <description><![CDATA[ Events from EMU Today ]]></description>
        <language>en</language>
        <pubDate>{{ now() }}</pubDate>

        @foreach($items as $item)
            <item>
                <title><![CDATA[{!! $item->title !!}]]></title>
                <link>{{ URL::to('/calendar/' . $item->start_date->format('Y') . '/' . $item->start_date->format('n') . '/' . $item->start_date->format('j') . '/' . $item->id) }}</link>
                <content:encoded><![CDATA[{!! $item->description . $item->location ? '<br><br>Location: ' . $item->location : '' !!}]]></content:encoded>
                <category><![CDATA[ events ]]></category>
                <author><![CDATA[{{ $item->contact_person }}]]></author>
                <guid>{{ URL::to('/calendar/' . $item->start_date->format('Y') . '/' . $item->start_date->format('n') . '/' . $item->start_date->format('j') . '/' . $item->id) }}</guid>
                <pubDate>{{ $item->start_date }}</pubDate>
            </item>
        @endforeach
    </channel>
</rss>