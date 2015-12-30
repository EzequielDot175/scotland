app.directive('imageSelectable', [function(){
	// Runs during compile
	return {
		// name: '',
		// priority: 1,
		// terminal: true,
		// scope: {}, // {} = isolate, true = child, false/undefined = no change
		// controller: function($scope, $element, $attrs, $transclude) {},
		// require: 'ngModel', // Array = multiple requires, ? = optional, ^ = check parent elements
		// restrict: 'A', // E = Element, A = Attribute, C = Class, M = Comment
		// template: '',
		// templateUrl: '',
		// replace: true,
		// transclude: true,
		// compile: function(tElement, tAttrs, function transclude(function(scope, cloneLinkingFn){ return function linking(scope, elm, attrs){}})),
		link: function(scp, elem, attr, controller) {
			// elem[0].style.css.cursor = "pointer";
			var current_scope = attr.imageSelectable;
				elem[0].style.cursor = "pointer";
				scp.$parent[current_scope][scp.$index]["selected"] = false;

			elem.on('click',function(){
				elem.toggleClass('image-selected-active');
			});
			// scp.$parent
			// console.info('Reporting elem:', );
			console.info('Reporting imageSelectable:', scp, elem, attr, controller);
		}
	};
}]);



app.directive('ngThumb', ['$window', function($window) {
        var helper = {
            support: !!($window.FileReader && $window.CanvasRenderingContext2D),
            isFile: function(item) {
                return angular.isObject(item) && item instanceof $window.File;
            },
            isImage: function(file) {
                var type =  '|' + file.type.slice(file.type.lastIndexOf('/') + 1) + '|';
                return '|jpg|png|jpeg|bmp|gif|'.indexOf(type) !== -1;
            }
        };

        return {
            restrict: 'A',
            template: '<canvas/>',
            link: function(scope, element, attributes) {
                if (!helper.support) return;

                var params = scope.$eval(attributes.ngThumb);

                if (!helper.isFile(params.file)) return;
                if (!helper.isImage(params.file)) return;

                var canvas = element.find('canvas');
                var reader = new FileReader();

                reader.onload = onLoadFile;
                reader.readAsDataURL(params.file);

                function onLoadFile(event) {
                    var img = new Image();
                    img.onload = onLoadImage;
                    img.src = event.target.result;
                }

                function onLoadImage() {
                    var width = params.width || this.width / this.height * params.height;
                    var height = params.height || this.height / this.width * params.width;
                    canvas.attr({ width: width, height: height });
                    canvas[0].getContext('2d').drawImage(this, 0, 0, width, height);
                }
            }
        };
    }]);

app.directive('ngMultiple', [function(){
    // Runs during compile
    return {
        // name: '',
        // priority: 1,
        // terminal: true,
        // scope: {}, // {} = isolate, true = child, false/undefined = no change
        // controller: function($scope, $element, $attrs, $transclude) {},
        // require: 'ngModel', // Array = multiple requires, ? = optional, ^ = check parent elements
        // restrict: 'A', // E = Element, A = Attribute, C = Class, M = Comment
        // template: '<span class="glyphicon"></span>',
        // templateUrl: '',
        // replace: true,
        // transclude: true,
        // compile: function(tElement, tAttrs, function transclude(function(scope, cloneLinkingFn){ return function linking(scope, elm, attrs){}})),
        link: function(scp, el, attr, ctrl) {
            // console.info('Reporting scp multiple:', attr.ngMultiple);
            if(Boolean(parseInt(attr.ngMultiple))){
                el.attr('multiple', 'true');
            }
        }
    };
}]);


app.directive('ngStarRating', ['$parse','$compile',function($parse,$compile){
    // Runs during compile
    return {
        // name: '',
        // priority: 1,
        // terminal: true,
        // scope: {}, // {} = isolate, true = child, false/undefined = no change
        // controller: function($scope, $element, $attrs, $transclude) {},
        // require: 'ngModel', // Array = multiple requires, ? = optional, ^ = check parent elements
        // restrict: 'A', // E = Element, A = Attribute, C = Class, M = Comment
        // template: '<span class="glyphicon">asd</span>',
        // templateUrl: '',
        // replace: true,
        // transclude: true,
        // compile: function(tElement, tAttrs, function transclude(function(scope, cloneLinkingFn){ return function linking(scope, elm, attrs){}})),
        link: function(scp, el, attr, ctrl) {

            var index = scp.$index || -1;
            var funcName = attr.ngStarAction;

            scp.$watch(function(){
                return attr.ngStarRating;
            },function(n,o){

                var stars = attr.ngStarRating.split("|");
                if(stars[0] != undefined){

                    el[0].innerHTML = "";
                    var html = [];

                    for (var i = 0; i < stars[1]; i++) {
                        var span = document.createElement("span");
                        span.style.cursor = "pointer";

                        if(i <= stars[0] - 1 ){
                            span.className = "glyphicon glyphicon-star";
                        }else{
                            span.className = "glyphicon glyphicon-star-empty";
                        }

                        if(funcName != undefined){
                            span.setAttribute('ng-click', funcName+"("+index+","+(i+1)+")");
                        }
                        html.push(span);
                    };
                    for (var i = 0; i < html.length; i++) {
                        el.append($compile(html[i])(scp));
                    };


                }

            });


           
        }
    };
}]);