jQuery(function($){

  /*
  * Extends
  *
  */
  $.fn.extend({
    showLoading: function() {
      this.removeClass('hidden');
    },
    hideLoading: function(){
      this.addClass('hidden');
    },
    toggleLoading: function(){
      this.toggleClass('hidden');
    }
  });

  $(document).ajaxSend(function() {
    $('#loading').showLoading();
  });

  $(document).ajaxComplete(function() {
    $('#loading').hideLoading();
  });

  var $selectCareer = $('#career-select');
  var $selectCourse = $('#course-select');
  var $selectType = $('#type-select');
  var $search = $('#search');

  /*
  * Global Functions
  *
  */
  window.clearSelectOptions = function($el) {
    $el.find('option:not(:first-child)').remove();
  }

  window.populateCourses = function(courses) {
    clearSelectOptions($selectCourse);
    courses.forEach(function(course){
      $selectCourse.append(
        '<option value="'+course.slug+'">'+course.name+'</option>'
      );
    });
  }

  window.populateTypes = function(types) {
    clearSelectOptions($selectType);
    types.forEach(function(type){
      $selectType.append(
        '<option value="'+type.slug+'">'+type.name+'</option>'
      );
    });
  }

  window.noResultsSelectMessage = function(id) {
    $("[data-id='"+id+"']")
      .find('.filter-option')
      .html('No hay Resultados... :(');
  }

  /*
  * Career Select Changes
  *
  */
  $selectCareer.change(function(e){
    e.preventDefault();

    $.get('/api/careers/'+$(this).val()+'/courses')
      .success(function(data){
        var courses = data.courses;
        if ( courses.length ) {
          populateCourses(courses);
          $selectCourse.prop('disabled', false);
          $selectCourse.selectpicker('refresh');
        } else {
          $selectType.prop('disabled', true);
          noResultsSelectMessage($selectCourse.attr('id'));
        }
      })
      .fail(function(err){
        $selectCourse.prop('disabled', true);
        $selectType.prop('disabled', true);
      })
  });

  /*
  * Course Select Changes
  *
  */
  $selectCourse.change(function(e){
    e.preventDefault();

    var career_slug = $selectCareer.val();

    $.get('/api/careers/'+career_slug+'/courses/'+$(this).val()+'/types')
      .success(function(data){
        var types = data.types;
        if ( types.length ) {
          populateTypes(types);
          $selectType.prop('disabled', false);
          $selectType.selectpicker('refresh');
        } else {
          $selectType.prop('disabled', true);
          noResultsSelectMessage($selectType.attr('id'));
        }
      })
      .fail(function(err){
        $selectType.prop('disabled', true);
      })
  });

  /*
  * Type Select Changes
  *
  */
  $selectType.change(function(e){
    e.preventDefault();
    $search.removeClass('disabled');
  });

  $search.click(function(e){
    e.preventDefault();
    if ( ! $(this).hasClass('disabled') ) {
      var course_slug = $selectCourse.val();
      var type_slug = $selectType.val();
      location.href = '/courses/' + course_slug + '/resources/' + type_slug;
    }
  });

  /*
  * Helpers
  *
  */

  $('.delete').click(function(e){
    var r = confirm("Desea borrar el recurso?");
    return r;
  });

  $('[data-href]').click(function(e){
    location.href = $(this).data('href');
  });

  $('[data-enable]').click(function(e){
    $($(this).data('enable')).prop('disabled', false);
  });

  $('button[data-toggle="button"]').on('click', function() {
    var $btn = $(this).button('loading');
  });

  $('button[type="submit"]').on('click', function() {
    $(this).closest('form').submit();
  });

  if ( window.jQuery && window.jQuery.validator )
  {
    jQuery.validator.setDefaults({
      highlight: function(element) {
        $(element).closest('.form-group').addClass('has-error');
      },
      errorElement: 'span',
      errorClass: 'help-block',
      errorPlacement: function(error, element) {
        var isCheckbox = (element.prop('type') === 'checkbox');
        var isRadop = (element.prop('type') === 'radio');
        $(element).closest('.form-group').append(error);
      }
    });

    $('.form.validate').validate({
      invalidHandler: function() {
        $('button[type="submit"]').button('reset').button('toggle');
      },
      submitHandler: function(form) {
        $('#loading').showLoading();
        form.submit();
      }
    });
  }
});
