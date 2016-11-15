<% if $LinkMode %>
	<a href="$Link" <% if $LinkNewTab %>target="_blank"<% end_if %>>
<% else %>
	<span>
<% end_if %>
<% if $Height %>
	<div class="banner-image" style="height: $Height; background-image: url('$Image.URL');"></div>
<% else %>
	$Image
<% end_if %>
<% if $Title %>
		<h5>$Title</h5>
<% end_if %>
<% if not $LinkMode %>
	</span>
<% else %>
	</a>
<% end_if %>
