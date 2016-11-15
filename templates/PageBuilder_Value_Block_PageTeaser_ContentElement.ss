<% with $Page %>
	<div class="page-$ClassName">
        <%-- let's check if class Page has fields that start with "Teaser" and use those if they exist --%>
        <% if $TeaserImage %>
			<a href="$Link" title="$Title.ATT" class="teaser-image">
                $TeaserImage
			</a>
        <% end_if %>
		<a href="$Link" title="$Title.ATT">
			<h4><% if $TeaserTitle %>$TeaserTitle<% else %>$MenuTitle<% end_if %></h4>
		</a>
        <% if $TeaserContent %>
			<p>$TeaserContent</p>
        <% end_if %>
		<a class="read-more" href="$Link" title="$Title.ATT">
            <% if $TeaserReadMoreTitle %>
                $TeaserReadMoreTitle
            <% else %>
                <%t PageBuilder_Value_Block_PageTeaser_ContentElement.TeaserReadMore 'read more' %>
            <% end_if %>
        </a>
	</div>
<% end_with %>
