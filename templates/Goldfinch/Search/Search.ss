<div class="text-center w-50 mx-auto my-5">
  <form method="get" action="{$Link}">
      <div class="form-group">
      <input name="q" type="text" class="form-control" placeholder="Search" maxlength="16" value="$paramGet(q)">
      </div>
      <div class="form-group mt-3">
      <a href="{$Link}" class="btn btn-outline-primary">Reset</a>
      <button type="submit" class="btn btn-primary">Submit</button>
      </div>
  </form>
</div>

<% if SearchDisplay %>
  <% if Message %>
      <div>$Message</div>
  <% else_if Results.Count %>
      <div>Total: $Results.Count</div>
      <div>
      <% loop Results %>
          <div>
              <a href="$Link">$Title</a>
              $Text.Highlight($Up.q)
          </div>
      <% end_loop %>
      <% include Goldfinch\Search\SearchPagination %>
      </div>
      <hr>
      <div>
      <% loop ObjectResults %>
          <% if Results.Count %>
              <div>Class: $ClassName</div>
              <% loop Results %>
                  <div>
                  <a href="$Link">$Title</a>
                  </div>
                  $Text.Highlight($Up.q)
              <% end_loop %>
              <% include Goldfinch\Search\SearchPagination %>
          <% end_if %>
      <% end_loop %>
      </div>
  <% else %>
      <p>Sorry, nothing found with <strong>$q</strong></p>
  <% end_if %>
<% end_if %>
