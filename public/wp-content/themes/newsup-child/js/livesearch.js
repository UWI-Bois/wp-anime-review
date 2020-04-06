class Search{
    constructor(){
        this.openButton = jQuery(".js-search-trigger");
        this.closeButton = jQuery(".js-search-overlay__close");
        this.searchOverlay = jQuery(".search-overlay");
        this.events();
        console.log("This is a JavaScript search. Working.");
    }
    events(){
        this.openButton.on("click", this.openOverlay.bind(this));
        this.closeButton.on("click", this.closeOverlay.bind(this));
    }
    openOverlay(){
        this.searchOverlay.addClass("search-overlay--active");
    }
    closeOverlay(){
        this.searchOverlay.removeClass("search-overlay--active");
    }
}
var LiveSearch = new Search();