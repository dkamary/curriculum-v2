// Custom function used by the application

const scrollingTo = (
  $,
  viewport,
  target,
  offset = 120,
  duration = 1000,
  delay = 500
) => {
  const $target = $(target);
  setTimeout(() => {
    viewport.animate(
      {
        scrollTop: $target.offset().top - offset,
      },
      duration
    );
  }, delay);
};

const ajaxFormSubmit = ($, form, before = null) => {
  console.log("ajaxFormSubmit");
  const $form = $(form);

  return $.ajax({
    type: $form.attr("method"),
    url: $form.attr("action"),
    data: $form.serialize(),
    beforeSend: function () {
      if (before) {
        before();
      }
    },
  });
};
