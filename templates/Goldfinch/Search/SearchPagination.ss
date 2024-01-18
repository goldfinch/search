<% if $Results.MoreThanOnePage %>
  <div>
    <% if $Results.NotFirstPage %>
    <a class="prev" href="$Results.PrevLink">Prev</a>
    <% end_if %>
    <% loop $Results.PaginationSummary %>
      <% if $CurrentBool %>
        $PageNum
      <% else %>
        <% if $Link %>
          <a href="$Link">$PageNum</a>
        <% else %>
        ...
        <% end_if %>
      <% end_if %>
    <% end_loop %>
    <% if $Results.NotLastPage %>
      <a class="next" href="$Results.NextLink">Next</a>
    <% end_if %>
  </div>
<% end_if %>
