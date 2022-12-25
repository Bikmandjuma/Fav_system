var Toast = {

  init: function(options) {
    this.setOptions(options, $.toast.options)
    this.build()
  },

  setOptions: function(options, extended_options) {
      this.options = $.extend( {}, extended_options, options )
  },

  build: function() {
    this.setup()
    this.setPosition()
    this.renderHTML()
    this.animate()
  },

  setup: function() {

    var wrapper = $('.toaster-wrapper')

    this.content = $(`<div class="toast-content">${this.options.content}</div>`)
    this.itemEl = $('<div class="toast"></div>')


    if (!wrapper.length) {

      wrapper = $('<div class="toaster-wrapper"></div>')

      $('body').append(wrapper)

    }

    if (this.options.stacking) {
      wrapper.find(`.toast.${this.options.hideClass}`).remove()
    } else {
      wrapper.find('.toast').remove()
    }

    this.itemEl.append(this.content)
    wrapper.prepend(this.itemEl)

    this.wrapper = wrapper
  },

  setPosition: function () {
    this.wrapper.removeClass().addClass(`toaster-wrapper ${this.options.position}`)
  },

  renderHTML: function() {
    window.setTimeout(() =>{
      // wait for toast item to load in DOM before
      // adding showClass
      this.itemEl.addClass(this.options.showClass)
    }, 1)
  },

  animate: function() {

    if (this.options.hideAfter) {
      window.setTimeout(() => {

        this.itemEl.removeClass(this.options.showClass)
        this.itemEl.addClass(this.options.hideClass)

      }, this.options.hideAfter)
    }

  },

  reset: function() {
    this.wrapper.empty()
  }

}

$.toast = function(options) {
  var toast = Object.create(Toast)
  toast.init(options)

  return {
    reset: function() {
      toast.reset()
    }
  }
}

// default options for the Toaster library
$.toast.options = {
  content: '',
  position: 'bottom-right',
  hideClass: 'toast-hide',
  showClass: 'toast-show',
  hideAfter: 3000,
  stacking: true,
}
