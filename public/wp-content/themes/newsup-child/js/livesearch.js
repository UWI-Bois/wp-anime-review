class Search{
    constructor(){
        this.openButton = jQuery(".search-trigger");
        this.closeButton = jQuery(".search-overlay__close");
        this.searchOverlay = jQuery(".search-overlay");
        this.events();
        console.log("This is a JavaScript search. Working.");
        console.log(this.openButton);
    }
    events(){
        this.openButton.on("click", this.openOverlay.bind(this));
        this.closeButton.on("click", this.closeOverlay.bind(this));
        console.log("Search events have been loaded.");
    }
    openOverlay(){
        this.searchOverlay.addClass("search-overlay--active");
        console.log("Overlay opened.");
    }
    closeOverlay(){
        this.searchOverlay.removeClass("search-overlay--active");
        console.log("Overlay closed.");
    }
}
var LiveSearch = new Search();