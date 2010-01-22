{def $base_url=ezini( 'NotificationSettings', 'WebsiteURLBase', 'ezcomments.ini' )}

<p>
Dear {$subscriber.email} <br />

<u>{$comment.name}</u> posted a new comment on <a href="">{$content_object.name}. </a>
</p>
<p>
<b>Comment summary</b>:<br>
{$comment.text}
<br />
<br />
<p>
For reply the content, please visit 
<a href="{concat( $base_url, '/', $content_object.main_node.url_alias )}">
  {concat( $base_url, '/', $content_object.main_node.url_alias )}
</a>
<br />
For setting your subscription, please visit 
<a href="{concat( $base_url, '/comment/settings/', $subscriber.hash_string )}">
    {concat( $base_url, '/comment/settings/', $subscriber.hash_string )}
</a>
</p>
<pre>
-----------------------------
Best Regards
eZ Systems
<a href="http://ez.no">http://ez.no</a>
</pre>
{undef $base_url}