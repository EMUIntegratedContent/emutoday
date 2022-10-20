<?= '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL ?>
<rss version="2.0" xmlns:atom="https://www.w3.org/2005/Atom" xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:webfeeds="http://webfeeds.org/rss/1.0" xmlns:media="http://search.yahoo.com/mrss/">
    <channel>
        <title><![CDATA[ EMU Today - Announcements ]]></title>
        <link><![CDATA[ {{ env('APP_URL') }}/feed/announcements ]]></link>
        <description><![CDATA[ Announcements from EMU Today ]]></description>
        <language>en</language>
        <pubDate>{{ now() }}</pubDate>

        @foreach($items as $item)
            @if($item->link)
                $item->announcement . =
            @endif
            <item>
                <title><![CDATA[{!! $item->title !!}]]></title>
                <link>{{ URL::to('/announcement') }}</link>
                <content:encoded>
                    <![CDATA[{!! $item->announcement !!}]]>
                    <![CDATA[{!! $item->link ? '<br><br>Link: <a href="'.$item->link.'">'. $item->link_txt . '</a>' : '' !!}]]>
                    <![CDATA[{!! $item->email_link ? '<br><br>Email: <a href="mailto:'.$item->email_link.'">'. $item->email_link_txt . '</a>' : '' !!}]]>
                    <![CDATA[{!! $item->phone ? '<br><br>Phone: '.$item->phone : '' !!}]]>
                </content:encoded>
                <category><![CDATA[ events ]]></category>
                <author><![CDATA[{{ $item->contact_person }}]]></author>
                <guid isPermaLink="false">{{ 'EMU Today announcement #' .$item->id }}</guid>
                <pubDate>{{ $item->start_date }}</pubDate>
            </item>
        @endforeach
    </channel>
</rss>