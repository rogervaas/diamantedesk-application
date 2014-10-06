define(['app',
  'tpl!modules/Task/templates/item.ejs',
  'tpl!modules/Task/templates/list.ejs'], function(App, taskTemplate, listTemplate){

  App.module('Task.List', function(List, App, Backbone, Marionette, $, _){

    List.Item = Marionette.ItemView.extend({
      tagName: "tr",
      template: taskTemplate,

      events : {
        'click' : "showClicked"
      },

      showClicked: function(e){
        e.preventDefault();
        e.stopPropagation();
        this.trigger("task:show", this.model);
      }
    });

    List.Items = Marionette.CompositeView.extend({
      tagName: "table",
      template: listTemplate,
      id: "task-list",
      className: "table table-hover table-bordered",
      childViewContainer: "tbody",
      childView: List.Item
    });

  });

  return App.Task.List;

});