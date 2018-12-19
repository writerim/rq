<% _.each( breadcrumb_ , function(bread){ %>
<li>
  <% if( bread.link ){ %>
  <a href="<%= bread.link %>">
    <% } %>
    <i class="glyphicon  <%= bread.icon %>"></i> <%= bread.name %>
    <% if( bread.link ){ %>
  </a>
  <% } %>
</li>
<% }) %>