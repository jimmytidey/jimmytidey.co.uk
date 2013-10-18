(function ( /*! Brunch !*/ ) {
    'use strict';

    var globals = typeof window !== 'undefined' ? window : global;
    if(typeof globals.require === 'function') return;

    var modules = {};
    var cache = {};

    var has = function (object, name) {
        return({}).hasOwnProperty.call(object, name);
    };

    var expand = function (root, name) {
        var results = [],
            parts, part;
        if(/^\.\.?(\/|$)/.test(name)) {
            parts = [root, name].join('/').split('/');
        } else {
            parts = name.split('/');
        }
        for(var i = 0, length = parts.length; i < length; i++) {
            part = parts[i];
            if(part === '..') {
                results.pop();
            } else if(part !== '.' && part !== '') {
                results.push(part);
            }
        }
        return results.join('/');
    };

    var dirname = function (path) {
        return path.split('/').slice(0, -1).join('/');
    };

    var localRequire = function (path) {
        return function (name) {
            var dir = dirname(path);
            var absolute = expand(dir, name);
            return globals.require(absolute);
        };
    };

    var initModule = function (name, definition) {
        var module = {
            id: name,
            exports: {}
        };
        definition(module.exports, localRequire(name), module);
        var exports = cache[name] = module.exports;
        return exports;
    };

    var require = function (name) {
        var path = expand(name, '.');

        if(has(cache, path)) return cache[path];
        if(has(modules, path)) return initModule(path, modules[path]);

        var dirIndex = expand(path, './index');
        if(has(cache, dirIndex)) return cache[dirIndex];
        if(has(modules, dirIndex)) return initModule(dirIndex, modules[dirIndex]);

        throw new Error('Cannot find module "' + name + '"');
    };

    var define = function (bundle, fn) {
        if(typeof bundle === 'object') {
            for(var key in bundle) {
                if(has(bundle, key)) {
                    modules[key] = bundle[key];
                }
            }
        } else {
            modules[bundle] = fn;
        }
    };

    globals.require = require;
    globals.require.define = define;
    globals.require.register = define;
    globals.require.brunch = true;
})();

window.require.register("application", function (exports, require, module) {
    // Application bootstrapper.
    Application = {
        initialize: function () {

            // var NS = 'http://purl.net/net/socialmirror/';

            //init survey ID
            window.surveyID = "TEST01";

            var HomeView = require('views/home_view');
            var AboutView = require('views/about_view');
            var PlayView = require('views/play_view');

            var Router = require('lib/router');

            this.homeView = new HomeView();
            this.aboutView = new AboutView();
            this.playView = new PlayView();

            this.router = new Router();
            if(typeof Object.freeze === 'function') Object.freeze(this);
        }
    }

    window.application = Application;

    module.exports = Application;

    _.templateSettings = {
        interpolate: /\{\{(.+?)\}\}/g
    };
});
window.require.register("initialize", function (exports, require, module) {
    var application = require('application');

    $(function () {
        application.initialize();
        Backbone.history.start();
    });

});
window.require.register("lib/router", function (exports, require, module) {
    var application = require('application');

    module.exports = Backbone.Router.extend({
        routes: {
            '': 'home',
            'questions': 'questions',
            'play': 'play',
            'about': 'about',
        },

        home: function () {
            $('#viewport').html(application.homeView.render().el);
        },

        about: function () {
            $('#viewport').html(application.aboutView.render().el);

            prescriptions.reset(JSON.parse(window.localStorage.getItem("prescriptions")));
            // console.log(prescriptions);
            $('#play-view').css({
                height: 'auto'
            });
            window.prescriptions.reset(JSON.parse(window.localStorage.getItem("prescriptions")));
            // window.prescriptions.reset(window.prescriptions.models);
            // $('.prescriptions').show();
            $('.prescriptions > .list').show();
        },


        play: function () {
            $('#viewport').html(application.playView.render().el);

            var Vertices = require('models/vertices');
            var vertices = new Vertices();
            window.vertices = vertices;

            var VerticesView = require('views/vertices_view');
            var verticesView = new VerticesView({
                collection: vertices
            });

            $('#play-view').append(verticesView.render().el);
            $('#play-view').css({
                height: '100%'
            });

            vertices.fetch();

            if(vertices.length == 0) {
                //create user node
                window.YOU = vertices.add({
                    name: 'YOU',
                    x: $('.vertices').width() / 2 - 41,
                    y: $('.vertices').height() - 2 * 41 - $('.vertices').offset().top
                }).at(0);

                window.YOU.save();
            } else {
                window.YOU = vertices.at(0);
            }


            // populate answers values
            if(window.YOU) {
                $(".question input").each(function (i, q) {
                    if(window.YOU.get($(q).attr('name')) != null) $(q).val(window.YOU.get($(q).attr('name')));
                });

                $(".question select").each(function (i, q) {
                    if(window.YOU.get($(q).attr('name')) != null) $(q).val(window.YOU.get($(q).attr('name')));
                });

                // set answers
                $(".question input").bind('blur change', function () {
                    window.YOU.set($(this).attr('name'), $(this).val());
                    window.YOU.save();
                });
                $(".question input").trigger('blur');

                var toCamelCase = function (str) {
                    return str.toLowerCase()
                        .replace(/['"]/g, '')
                        .replace(/\W+/g, ' ')
                        .replace(/ (.)/g, function ($1) {
                            return $1.toUpperCase();
                        })
                        .replace(/ /g, '');
                }

                $(".question select").bind('blur change', function () {

                    var val = $(this).val();

                    if(val != null && val != "" && !(val instanceof Array)) {
                        //clear previous value, FALSE for now FIXME
                        if(typeof window.YOU.get($(this).attr('name')) != 'undefined') window.YOU.set($(this).attr('name') + '_' + toCamelCase(window.YOU.get($(this).attr('name'))), false);

                        //set new value
                        window.YOU.set($(this).attr('name') + '_' + toCamelCase($(this).val()), true);
                    }

                    window.YOU.set($(this).attr('name'), $(this).val());
                    window.YOU.set($(this).attr('name') + '_index', this.selectedIndex);

                    window.YOU.save({
                        silent: true
                    });
                });

                //trigger blur (save default values) on select questions
                $(".question select").trigger('blur');


            }

            //position YOU
            // var setYOU = function (){
            //         if ($('.vertices') == 0) setTimeout(setYOU, 500);
            //         console.log('setYOU');
            //         window.YOU.set('x', $('.vertices').width()/2 - 41);
            //         window.YOU.set('y', $('.vertices').height() - 2*41 - $('.vertices').offset().top);
            //       }


        }

    });

});
window.require.register("lib/view_helper", function (exports, require, module) {

});
window.require.register("models/collection", function (exports, require, module) {
    // Base class for all collections.
    module.exports = Backbone.Collection.extend({

    });

});
window.require.register("models/model", function (exports, require, module) {
    // Base class for all models.
    module.exports = Backbone.Model.extend({

    });

});
window.require.register("models/prescription", function (exports, require, module) {
    module.exports = Backbone.Model.extend({
        idAttribute: "_id",

        defaults: function () {
            return {
                title: "new prescription",
                desc: "",
                type: "",
                sort: 0
            };
        }
    });

});
window.require.register("models/prescriptions", function (exports, require, module) {
    var Prescription = require('models/prescription');

    module.exports = Backbone.Collection.extend({
        model: Prescription,
        // url: function() {
        //     return 'http://socialmirror.namebound.net:3000/v1/' + window.surveyID + '/prescriptions';
        // },

        initialize: function () {
            console.log('init prescriptions');
        }
    });

});
window.require.register("models/question", function (exports, require, module) {
    module.exports = Backbone.Model.extend({
        idAttribute: "_id"
    });

});
window.require.register("models/questions", function (exports, require, module) {
    var Question = require('models/question');

    module.exports = Backbone.Collection.extend({
        model: Question,
        // url:   'questions.json',
        // url: 	'http://socialmirror.namebound.net:3000/api/questions',
        // url: function() {
        //       return 'http://socialmirror.namebound.net:3000/v1/' + window.surveyID + '/questions';
        //   },

        initialize: function () {
            console.log('init questions');
        }
    });

});
window.require.register("models/vertex", function (exports, require, module) {
    module.exports = Backbone.Model.extend({

    });

});
window.require.register("models/vertices", function (exports, require, module) {
    var Vertex = require('models/vertex');

    module.exports = Backbone.Collection.extend({
        model: Vertex,
        url: 'vertices.json',
        localStorage: new Backbone.LocalStorage("Vertices"),

        initialize: function () {
            console.log('init vertices');
            // _.extend(this, new Backbone.Memento(this));
        }
    });

});
window.require.register("views/about_view", function (exports, require, module) {
    var View = require('./view');
    var template = require('./templates/about');

    var Prescription = require('models/prescription');
    var Prescriptions = require('models/prescriptions');

    var PrescriptionsView = require('./prescriptions_view');

    module.exports = View.extend({
        id: 'about-view',
        template: template,

        afterRender: function () {


            var prescriptions = new Prescriptions();
            // alert(this.$('.prescriptions').length);
            var prescriptionsView = new PrescriptionsView({
                el: this.$('.prescriptions'),
                collection: prescriptions
            });

            console.log(prescriptionsView.render().el);
            $('.prescriptions').append(prescriptionsView.render().el);

            // prescriptions.fetch();
            window.prescriptions = prescriptions;




            return this;

        }
    });

});
window.require.register("views/home_view", function (exports, require, module) {
    var View = require('./view');
    var template = require('./templates/home');

    module.exports = View.extend({
        id: 'home-view',
        template: template,

        afterRender: function () {
            // console.log('home-view afterRender');

            $('canvas').remove();

            $(this.el).find('#clear').click(function () {
                // var uuid = window.localStorage.getItem('sub-c-6dc73c52-5a8a-11e2-83f4-12313f022c90uuid');
                var survey = window.localStorage.getItem("survey");
                var psurvey = window.localStorage.getItem("prescriptions");
                var backup = window.localStorage.getItem("backup");
                var data = window.localStorage.getItem("DATA");
                // var backup = window.localStorage.getItem("backup") + " \n " + JSON.stringify(vertices.toJSON());

                window.localStorage.clear();
                window.localStorage.clear();

                for(var i = 0, len = localStorage.length; i < len; i++) {  
                    var key = localStorage.key(i);  
                    localstorage.removeItem(key);
                }

                if(window.questions) window.questions.reset();
                if(window.prescriptions) window.prescriptions.reset();
                if(window.vertices) window.vertices.reset();


                alert('Data cleared!')
                window.localStorage.setItem("Vertices", null);

                window.localStorage.clear();
                window.localStorage.clear();

                // window.localStorage.setItem('sub-c-6dc73c52-5a8a-11e2-83f4-12313f022c90uuid', uuid);
                window.localStorage.setItem("backup", backup);
                window.localStorage.setItem("DATA", data);
                window.localStorage.setItem("survey", survey);
                window.localStorage.setItem("prescriptions", psurvey);
            });

            $(this.el).find('.loadSurvey').click(function () {

                var backup = window.localStorage.getItem("backup"); // + " \n " + JSON.stringify(vertices.toJSON());
                var survey = window.localStorage.getItem("survey");
                var surveyPrescriptions = window.localStorage.getItem("prescriptions");
                var data = window.localStorage.getItem("DATA");

                window.localStorage.clear();
                window.localStorage.clear();

                window.localStorage.setItem("DATA", data);
                window.localStorage.setItem("backup", backup);
                window.localStorage.setItem("survey", survey);
                window.localStorage.setItem("prescriptions", surveyPrescriptions);

                var ID = $('#clone').val();
                window.surveyID = ID;

                // window.surveyID = "TEST01";

                $.getJSON('http://socialmirror.namebound.net/v1/' + window.surveyID + '/questions', function (data) {
                    window.localStorage.setItem("survey", JSON.stringify(data));

                    $.getJSON('http://socialmirror.namebound.net/v1/' + window.surveyID + '/prescriptions', function (data) {
                        window.localStorage.setItem("prescriptions", JSON.stringify(data));

                        $('#survey-modal').modal('hide');
                        application.router.navigate('#play', {
                            trigger: true
                        });
                    });

                });




            });



        }
    });

});
window.require.register("views/play_view", function (exports, require, module) {
    var View = require('./view');
    var template = require('./templates/play');

    var Question = require('models/question');
    var Questions = require('models/questions');

    var QuestionView = require('./question_view');
    var QuestionsView = require('./questions_view');

    var Prescription = require('models/prescription');
    var Prescriptions = require('models/prescriptions');

    var PrescriptionsView = require('./prescriptions_view');

    module.exports = View.extend({
        id: 'play-view',
        template: template,

        afterRender: function () {

            var questions = new Questions();


            var questionsView = new QuestionsView({
                el: this.$('.questions'),
                collection: questions
            });

            $('.questions').append(questionsView.render().el);

            // questions.fetch();
            //window.localStorage.getItem("survey")
            questions.reset(JSON.parse(window.localStorage.getItem("survey")));




            var prescriptions = new Prescriptions();
            // alert(this.$('.prescriptions').length);
            var prescriptionsView = new PrescriptionsView({
                el: this.$('.prescriptions'),
                collection: prescriptions
            });

            // console.log(prescriptionsView.render().el);
            $('.prescriptions').append(prescriptionsView.render().el);

            // prescriptions.fetch();
            prescriptions.reset(JSON.parse(window.localStorage.getItem("prescriptions")));
            console.log(prescriptions);
            window.prescriptions = prescriptions;




        }
    });

});
window.require.register("views/prescription_view", function (exports, require, module) {
    var View = require('./view');
    var template = require('./templates/prescription');

    module.exports = View.extend({
        className: 'prescription', //FIXME
        template: template,
        tagName: 'div',


        initialize: function () {
            console.log('init prescriptionView');
            _.bindAll(this, 'render');
            this.model.bind('change', this.render);
        },

        render: function () {
            this.$el.html(this.template(this.model.toJSON()));

            var tags = this.model.get('tags');
            for(var i = 0; i < tags.length; i++) {
                this.$el.addClass(tags[i]);
            }

            return this;
        }

    });

});

window.require.register("views/prescriptions_view", function (exports, require, module) {
    var View = require('./view');
    var template = require('./templates/prescriptions');

    var Prescription = require('models/prescription');
    var PrescriptionView = require('views/prescription_view');

    module.exports = View.extend({
        className: 'editQuestions', //FIXME
        template: template,

        initialize: function () {
            console.log('init prescriptionsView');
            _.bindAll(this, 'render');
            this.collection.bind('reset', this.render);
        },

        render: function () {
            var $prescriptions,
                collection = this.collection;

            window.prescriptions = collection;

            collection.comparator = function (model) {
                return parseInt(model.get('score'));
            };

            function computeDensity() {
                if(typeof window.vertices == 'undefined') return;
                var data = window.vertices.toJSON();
                var verticesCount = data.length;
                var edges = 0;
                // var edges = verticesCount - 1; //adding by default equivalent no of connections to YOU

                for(var j = 0; j < verticesCount; j++) {
                    // TODO skip connections to YOU?
                    var connections = 0;
                    if(data[j].connections) connections = data[j].connections.length;
                    edges += connections;
                }


                var density = (2 * edges) / (verticesCount * (verticesCount - 1));

                if(isNaN(density)) density = 0;

                window.YOU.set('density', density);
                console.log('Density ' + density);
            }
            computeDensity();

            function evaluate(prescription) {
                var value = -1;

                try {
                    var code = new Function(
                        "with(window.YOU.toJSON()){\n" + prescription.get('code') + "\n}"
                    );
                    value = code();
                } catch(err) {
                    if(console.warn) console.warn(prescription.get('title'), err.name, err.message);
                    return -9999;
                }

                // console.log(prescription, value);
                if(typeof value == 'undefined') return 0;

                return value;
            }

            // run macros
            collection.each(function (prescription) {
                if(_.contains(prescription.get('tags'), 'skip')) return;
                if(!_.contains(prescription.get('tags'), 'macro')) return;
                if(_.contains(prescription.get('tags'), 'composite')) return;
                prescription.set('score', evaluate(prescription));
                console.log('MACRO: ' + prescription.get('score'), prescription.get('title'));
            });

            collection.each(function (prescription) {
                if(_.contains(prescription.get('tags'), 'skip')) return;
                if(!_.contains(prescription.get('tags'), 'composite')) return;
                prescription.set('score', evaluate(prescription));
                console.log('CMACRO: ' + prescription.get('score'), prescription.get('title'));
            });

            //run prescriptions      
            collection.each(function (prescription) {
                // var view = new PrescriptionView({
                //  model: prescription,
                //  collection: collection
                // });
                if(_.contains(prescription.get('tags'), 'skip')) return;
                if(_.contains(prescription.get('tags'), 'macro')) return;
                prescription.set('score', evaluate(prescription));

                console.log('P: ' + prescription.get('score'), prescription.get('title'));

            });



            collection.sort({
                silent: true
            });

            $(this.el).html(this.template({}));

            // $('#editQuestionsW').replaceWith('<ul id="editQuestionsW"></ul>');
            $preroll = $('.prescriptions .pre').empty().hide();
            $prescriptions = $('.prescriptions .list').empty().hide();
            $postroll = $('.prescriptions .post').empty().hide();

            if(window.YOU) {
                window.YOU_JSON = window.YOU.toJSON();
                // plug some templates in here...
            }

            // var showAll = $('#about-view').length > 0;

            collection.each(function (prescription) {

                if(_.contains(prescription.get('tags'), 'skip')) return;

                var view = new PrescriptionView({
                    model: prescription,
                    collection: collection
                });


                if(_.contains(prescription.get('tags'), 'preroll')) {
                    if(prescription.get('score') != 0) $preroll.prepend(view.render().el);
                } else if(_.contains(prescription.get('tags'), 'postroll')) {
                    $postroll.prepend(view.render().el);
                } else {
                    $prescriptions.prepend(view.render().el);
                    if(prescription.get('score') > 0) {
                        $(view.render().el).addClass('match');
                    } else if(prescription.get('score') < 0) {
                        $(view.render().el).addClass('error');
                        $(view.render().el).addClass('nomatch');
                    } else {
                        $(view.render().el).addClass('nomatch');
                    }
                }

                $(view.render().el)
                    .data('view', view)
                    .data('model', prescription);
                // .addClass((prescription.get('type') == 'skip')?'skip':'')
                // .find('select').val(prescription.get('type'));
            });

            //MUTEX
            $('.mutex1').not($('.mutex1').get(0)).remove();
            $('.mutex2').not($('.mutex2').get(0)).remove();
            $('.mutex3').not($('.mutex3').get(0)).remove();
            $('.mutex4').not($('.mutex4').get(0)).remove();

            // $('#play-view').css({height: 'auto'});
            $('#saveSurvey').click(function () {
                //attach prescriptions to YOU
                window.YOU.set('prescribed', window.prescriptions.toJSON());

                var backup = window.localStorage.getItem("backup") + "\n\n------------------------------------------\n\n" + JSON.stringify(vertices.toJSON());

                var data = window.localStorage.getItem("DATA") + "\n\n------------------------------------------\n\n" + JSON.stringify(sjcl.encrypt("7d0f953e3345", JSON.stringify(vertices.toJSON())));

                window.localStorage.setItem("backup", backup);
                window.localStorage.setItem("DATA", data);

                alert('Saved!');

            });

            return this;
        }


    });

});
window.require.register("views/question_view", function (exports, require, module) {
    var View = require('./view');
    var template = require('./templates/question');

    module.exports = View.extend({
        className: 'question',
        template: template,

        initialize: function () {
            console.log('init questionView');
            _.bindAll(this, 'render');
            this.model.bind('change', this.render);
        },

        render: function () {
            this.$el.html(this.template(this.model.toJSON()));
            return this;
        }

    });

});
window.require.register("views/questions_view", function (exports, require, module) {
    var View = require('./view');
    var template = require('./templates/questions');

    var Question = require('models/question');
    var QuestionView = require('views/question_view');

    module.exports = View.extend({
        className: 'questions',
        template: template,
        current: 0,

        initialize: function () {
            console.log('init questionsView');
            _.bindAll(this, 'render');
            this.collection.bind('reset', this.render);
        },

        render: function () {
            var $questions,
                collection = this.collection;

            window.questions = collection;

            collection.comparator = function (model) {
                return parseInt(model.get('sort'));
            };

            collection.sort();

            $(this.el).html(this.template({}));
            $questions = $(this.el); //this.$('.questions');

            collection.each(function (question) {
                var view = new QuestionView({
                    model: question,
                    collection: collection
                });
                if(question.get('type') != 'skip') {
                    $questions.find('.questionBlock').append(view.render().el);
                }
            });

            $questions.find(".question .vertex").draggable({
                revert: "invalid",
                helper: "clone"
            });

            // populate answers values
            // if (window.YOU) {
            // $questions.find( ".question input" ).each(function(i, q) {
            //   if (window.YOU.get($(q).attr('name')) != null) $(q).val(window.YOU.get($(q).attr('name')));
            // });
            // 
            // $questions.find( ".question select" ).each(function(i, q) {
            //   if (window.YOU.get($(q).attr('name')) != null) $(q).val(window.YOU.get($(q).attr('name')));
            // });
            // 
            // // set answers
            // $questions.find( ".question input" ).bind('blur change', function() {
            //   window.YOU.set($(this).attr('name'), $(this).val());
            //   window.YOU.save();
            // });
            // 
            // $questions.find( ".question select" ).bind('blur change', function() {
            //   window.YOU.set($(this).attr('name'), $(this).val());
            //   window.YOU.save();
            // });
            // }



            $questions.find('#END').click(function () {
                window.saveDATA();
            });

            $questions.find('#PRESCRIBE').click(function () {
                $('.questions').hide();
                $('.vertices').hide();
                $('canvas').hide();
                $('#play-view').css({
                    height: 'auto'
                });
                window.prescriptions.reset(JSON.parse(window.localStorage.getItem("prescriptions")));
                // window.prescriptions.reset(window.prescriptions.models);

                $('.prescriptions').show();
                $('.prescriptions > div').show();

                //JIMMY HACK 
                var email_address = 'jimmytidey@gmail.com';
                var message = $('.prescription').text();
                data = {'email_address': email_address, 'message': message}
                
                //$.post('http://jimmytidey.co.uk/mailer.php', data);

            });

            this.show(0);



            return this;
        },

        events: {
            'click #prev': 'previous',
            'click #next': 'next'
        },

        show: function (index) {
            console.log(index);
            $($(this.el).find('.question').hide().get(index)).show();

            if(index == 0) {
                $('#prev').addClass('disabled');
            } else {
                $('#prev').removeClass('disabled');
            }

            if(index == this.collection.length - 1) {
                $('#next').addClass('disabled');
            } else {
                $('#next').removeClass('disabled');
            }

            // todo toggle question
            if(this.collection.at(index) != null) {
                window.questionID = this.collection.at(index).get('_id');
                window.question = this.collection.at(index);
            } else {
                window.questionID = "NIL";
                window.question = null;
            }
            if(typeof vertices != 'undefined') vertices.reset(vertices.models);;


        },

        previous: function () {
            if(this.current > 0) {
                this.show(--this.current);
            }
        },

        next: function () {
            if(this.current < this.collection.length - 1) {
                this.show(++this.current);
            }
        }

    });

});
window.require.register("views/templates/about", function (exports, require, module) {
    module.exports = function anonymous(locals, attrs, escape, rethrow, merge) {
        attrs = attrs || jade.attrs;
        escape = escape || jade.escape;
        rethrow = rethrow || jade.rethrow;
        merge = merge || jade.merge;
        var buf = [];
        with(locals || {}) {
            var interp;
            buf.push('<div class="masthead"><ul class="nav nav-pills pull-right"><li><a href="#">Back</a></li></ul><h3>Social Mirror</h3></div><hr/><div class="prescriptions"></div>');
        }
        return buf.join("");
    };
});
window.require.register("views/templates/home", function (exports, require, module) {
    module.exports = function anonymous(locals, attrs, escape, rethrow, merge) {
        attrs = attrs || jade.attrs;
        escape = escape || jade.escape;
        rethrow = rethrow || jade.rethrow;
        merge = merge || jade.merge;
        var buf = [];
        with(locals || {}) {
            var interp;
            buf.push('<div class="masthead"><ul class="nav nav-pills pull-right"><!--li.active--><!--    a(href=\'#\') Home--><li><a href="http://socialmirror.org.uk/" target="_new">About</a></li></ul><h3>Social Mirror</h3></div><hr/><div class="jumbotron"><!--h1 Social Mirror--><div class="center"><a id="clear" href="#play" class="round btn btn-large btn-primary"><span>NEW SURVEY</span></a></div><hr/><div class="center"><a href="#play" class="btn btn-large btn-primary"><span>RESUME SURVEY</span></a></div><hr/><div class="center"><a tabindex="-1" href="#survey-modal" data-toggle="modal" class="btn btn-large btn-primary"><span>LOAD SURVEY</span></a></div><hr/><hr/><div class="center"><a href="#about" class="btn btn-large btn-link"><span>SHOW ALL PRESCRIPTIONS</span></a></div><hr/><hr/><div class="center"><a id="upload" tabindex="-1" href="#" class="btn btn-large"><span>UPLOAD DATA TO SERVER</span></a></div></div><div id="survey-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" class="modal hide fade"><div class="modal-header"><button type="button" data-dismiss="modal" aria-hidden="true" class="close">×</button><h3 id="myModalLabel">Load Survey</h3></div><div class="modal-body center"><label>Survey ID</label><input id="clone" type="text" placeholder="ID"/></div><div class="modal-footer"><button data-dismiss="modal" aria-hidden="true" class="btn">Close</button><button class="btn btn-primary loadSurvey">Load</button></div></div>');
        }
        return buf.join("");
    };
});
window.require.register("views/templates/index", function (exports, require, module) {
    module.exports = function anonymous(locals, attrs, escape, rethrow, merge) {
        attrs = attrs || jade.attrs;
        escape = escape || jade.escape;
        rethrow = rethrow || jade.rethrow;
        merge = merge || jade.merge;
        var buf = [];
        with(locals || {}) {
            var interp;
            buf.push('<div id="content"><h1>brunch</h1></div>');
        }
        return buf.join("");
    };
});
window.require.register("views/templates/layout", function (exports, require, module) {
    module.exports = function anonymous(locals, attrs, escape, rethrow, merge) {
        attrs = attrs || jade.attrs;
        escape = escape || jade.escape;
        rethrow = rethrow || jade.rethrow;
        merge = merge || jade.merge;
        var buf = [];
        with(locals || {}) {
            var interp;
            buf.push('<!DOCTYPE html><html lang="en" class="no-js"><head><meta charset="utf-8"><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><title>UI</title><link rel="stylesheet" href="/stylesheets/app.css"><script src="javascripts/vendor.js"></script><script src="javascripts/app.js"></script><script>require(\'initialize\');</script><link rel="apple-touch-icon-precomposed" sizes="144x144" href="apple-touch-icon-144x144-precomposed.png"><link rel="apple-touch-icon-precomposed" sizes="114x114" href="apple-touch-icon-114x114-precomposed.png"><link rel="apple-touch-icon-precomposed" sizes="72x72" href="apple-touch-icon-72x72-precomposed.png"><link rel="apple-touch-icon-precomposed" href="apple-touch-icon-57x57-precomposed.png"><link rel="shortcut icon" href="favicon.ico"></head><body></body></html>');
        }
        return buf.join("");
    };
});
window.require.register("views/templates/play", function (exports, require, module) {
    module.exports = function anonymous(locals, attrs, escape, rethrow, merge) {
        attrs = attrs || jade.attrs;
        escape = escape || jade.escape;
        rethrow = rethrow || jade.rethrow;
        merge = merge || jade.merge;
        var buf = [];
        with(locals || {}) {
            var interp;
            buf.push('<div class="questions"></div><div class="prescriptions"></div><div class="menu"><!--a#undo.disabled.btn.pull-left--><!--	i.icon-undo--><a href="#" id="del" class="btn btn-link pull-right"><i class="icon-signout"></i></a></div><div id="you-wrapper" class="row-fluid"><div class="span6"><div id="you" class="round btn"><h1>YOU</h1></div></div></div>');
        }
        return buf.join("");
    };
});
window.require.register("views/templates/prescription", function (exports, require, module) {
    module.exports = function anonymous(locals, attrs, escape, rethrow, merge) {
        attrs = attrs || jade.attrs;
        escape = escape || jade.escape;
        rethrow = rethrow || jade.rethrow;
        merge = merge || jade.merge;
        var buf = [];
        with(locals || {}) {
            var interp;
            if(window.YOU_JSON) {
                var ttitle = _.template(title);
                buf.push('<strong class="title"> ');
                var __val__ = ttitle(window.YOU_JSON)
                buf.push(escape(null == __val__ ? "" : __val__));
                buf.push('<span class="score">(' + escape((interp = score) == null ? '' : interp) + ')</span></strong><!--p #{desc}--><p> ');
                var tdesc = _.template(desc);
                var __val__ = tdesc(window.YOU_JSON)
                buf.push(escape(null == __val__ ? "" : __val__));
                buf.push('</p>');
                if(typeof longdesc != 'undefined') {
                    var tldesc = _.template(longdesc);
                    var _longdesc = tldesc(window.YOU_JSON)
                    buf.push('<div>' + ((interp = _longdesc) == null ? '' : interp) + '</div>');
                }
                if(_.contains(tags, 'savesurvey')) {
                    buf.push('<div class="center"><a id="saveSurvey" href="#" class="btn btn-large btn-primary"><span>SAVE SURVEY</span></a><p></p><hr/><p></p><hr/></div>');
                }
            }
        }
        return buf.join("");
    };
});
window.require.register("views/templates/prescriptions", function (exports, require, module) {
    module.exports = function anonymous(locals, attrs, escape, rethrow, merge) {
        attrs = attrs || jade.attrs;
        escape = escape || jade.escape;
        rethrow = rethrow || jade.rethrow;
        merge = merge || jade.merge;
        var buf = [];
        with(locals || {}) {
            var interp;
            buf.push('<div class="pre"></div><div class="list"></div><div class="post"></div>');
        }
        return buf.join("");
    };
});
window.require.register("views/templates/question", function (exports, require, module) {
    module.exports = function anonymous(locals, attrs, escape, rethrow, merge) {
        attrs = attrs || jade.attrs;
        escape = escape || jade.escape;
        rethrow = rethrow || jade.rethrow;
        merge = merge || jade.merge;
        var buf = [];
        with(locals || {}) {
            var interp;
            buf.push('<div class="center"><h1><!--span.muted Q: --><span>' + escape((interp = title) == null ? '' : interp) + '</span></h1><p class="muted">' + escape((interp = desc) == null ? '' : interp) + '</p>');
            if(type == 'graph') {
                // iterate answers
                ;
                (function () {
                    if('number' == typeof answers.length) {

                        for(var $index = 0, $$l = answers.length; $index < $$l; $index++) {
                            var item = answers[$index];

                            if(item.label != 'Empty') {
                                buf.push('<div class="vertex blue"><span>');
                                var __val__ = item.label
                                buf.push(escape(null == __val__ ? "" : __val__));
                                buf.push('</span></div>');
                            }
                        }

                    } else {
                        var $$l = 0;
                        for(var $index in answers) {
                            $$l++;
                            var item = answers[$index];

                            if(item.label != 'Empty') {
                                buf.push('<div class="vertex blue"><span>');
                                var __val__ = item.label
                                buf.push(escape(null == __val__ ? "" : __val__));
                                buf.push('</span></div>');
                            }
                        }

                    }
                }).call(this);

            }
            if(type == 'text') {
                // iterate answers
                ;
                (function () {
                    if('number' == typeof answers.length) {

                        for(var $index = 0, $$l = answers.length; $index < $$l; $index++) {
                            var item = answers[$index];

                            buf.push('<!--input(name=_id + \'-\' + item.value, placeholder=item.label)--><input');
                            buf.push(attrs({
                                'name': (item.value),
                                'placeholder': (item.label),
                                'autocomplete': ("off")
                            }, {
                                "name": true,
                                "placeholder": true,
                                "autocomplete": true
                            }));
                            buf.push('/>');
                        }

                    } else {
                        var $$l = 0;
                        for(var $index in answers) {
                            $$l++;
                            var item = answers[$index];

                            buf.push('<!--input(name=_id + \'-\' + item.value, placeholder=item.label)--><input');
                            buf.push(attrs({
                                'name': (item.value),
                                'placeholder': (item.label),
                                'autocomplete': ("off")
                            }, {
                                "name": true,
                                "placeholder": true,
                                "autocomplete": true
                            }));
                            buf.push('/>');
                        }

                    }
                }).call(this);

            }
            if(type == 'select') {
                buf.push('<select');
                buf.push(attrs({
                    'name': (name)
                }, {
                    "name": true
                }));
                buf.push('><option value="" selected="selected">');
                var __val__ = "please select"
                buf.push(escape(null == __val__ ? "" : __val__));
                buf.push('</option>');
                // iterate answers
                ;
                (function () {
                    if('number' == typeof answers.length) {

                        for(var $index = 0, $$l = answers.length; $index < $$l; $index++) {
                            var option = answers[$index];

                            buf.push('<option');
                            buf.push(attrs({
                                'value': (option.value)
                            }, {
                                "value": true
                            }));
                            buf.push('>');
                            var __val__ = option.label
                            buf.push(escape(null == __val__ ? "" : __val__));
                            buf.push('</option>');
                        }

                    } else {
                        var $$l = 0;
                        for(var $index in answers) {
                            $$l++;
                            var option = answers[$index];

                            buf.push('<option');
                            buf.push(attrs({
                                'value': (option.value)
                            }, {
                                "value": true
                            }));
                            buf.push('>');
                            var __val__ = option.label
                            buf.push(escape(null == __val__ ? "" : __val__));
                            buf.push('</option>');
                        }

                    }
                }).call(this);

                buf.push('</select>');
            }
            if(type == 'multiselect') {
                buf.push('<select');
                buf.push(attrs({
                    'name': (name),
                    'multiple': ('multiple')
                }, {
                    "name": true,
                    "multiple": true
                }));
                buf.push('><option value="">');
                var __val__ = "please select"
                buf.push(escape(null == __val__ ? "" : __val__));
                buf.push('</option>');
                // iterate answers
                ;
                (function () {
                    if('number' == typeof answers.length) {

                        for(var $index = 0, $$l = answers.length; $index < $$l; $index++) {
                            var option = answers[$index];

                            buf.push('<option');
                            buf.push(attrs({
                                'value': (option.value)
                            }, {
                                "value": true
                            }));
                            buf.push('>');
                            var __val__ = option.label
                            buf.push(escape(null == __val__ ? "" : __val__));
                            buf.push('</option>');
                        }

                    } else {
                        var $$l = 0;
                        for(var $index in answers) {
                            $$l++;
                            var option = answers[$index];

                            buf.push('<option');
                            buf.push(attrs({
                                'value': (option.value)
                            }, {
                                "value": true
                            }));
                            buf.push('>');
                            var __val__ = option.label
                            buf.push(escape(null == __val__ ? "" : __val__));
                            buf.push('</option>');
                        }

                    }
                }).call(this);

                buf.push('</select>');
            }
            if(type == 'stars') {
                buf.push('<select');
                buf.push(attrs({
                    'name': (name)
                }, {
                    "name": true
                }));
                buf.push('><option value="1" selected="selected">');
                var __val__ = "★"
                buf.push(escape(null == __val__ ? "" : __val__));
                buf.push('</option><option value="2">');
                var __val__ = "★★"
                buf.push(escape(null == __val__ ? "" : __val__));
                buf.push('</option><option value="3">');
                var __val__ = "★★★"
                buf.push(escape(null == __val__ ? "" : __val__));
                buf.push('</option><option value="4">');
                var __val__ = "★★★★"
                buf.push(escape(null == __val__ ? "" : __val__));
                buf.push('</option><option value="5">');
                var __val__ = "★★★★★"
                buf.push(escape(null == __val__ ? "" : __val__));
                buf.push('</option></select>');
            }
            if(type == '10stars') {
                buf.push('<select');
                buf.push(attrs({
                    'name': (name)
                }, {
                    "name": true
                }));
                buf.push('><option value="1" selected="selected">');
                var __val__ = "★"
                buf.push(escape(null == __val__ ? "" : __val__));
                buf.push('</option><option value="2">');
                var __val__ = "★★"
                buf.push(escape(null == __val__ ? "" : __val__));
                buf.push('</option><option value="3">');
                var __val__ = "★★★"
                buf.push(escape(null == __val__ ? "" : __val__));
                buf.push('</option><option value="4">');
                var __val__ = "★★★★"
                buf.push(escape(null == __val__ ? "" : __val__));
                buf.push('</option><option value="5">');
                var __val__ = "★★★★★"
                buf.push(escape(null == __val__ ? "" : __val__));
                buf.push('</option><option value="6">');
                var __val__ = "★★★★★★"
                buf.push(escape(null == __val__ ? "" : __val__));
                buf.push('</option><option value="7">');
                var __val__ = "★★★★★★★"
                buf.push(escape(null == __val__ ? "" : __val__));
                buf.push('</option><option value="8">');
                var __val__ = "★★★★★★★★"
                buf.push(escape(null == __val__ ? "" : __val__));
                buf.push('</option><option value="9">');
                var __val__ = "★★★★★★★★★"
                buf.push(escape(null == __val__ ? "" : __val__));
                buf.push('</option><option value="10">');
                var __val__ = "★★★★★★★★★★"
                buf.push(escape(null == __val__ ? "" : __val__));
                buf.push('</option></select>');
            }
            if(title == 'Thank you!') {
                buf.push('<a id="END" class="btn">SUBMIT DATA</a>');
            }
            if(_.contains(tags, 'prescribe')) {
                buf.push('<a id="PRESCRIBE" class="btn">SHOW PRESCRIPTIONS</a>');
            }
            buf.push('</div>');
        }
        return buf.join("");
    };
});
window.require.register("views/templates/questions", function (exports, require, module) {
    module.exports = function anonymous(locals, attrs, escape, rethrow, merge) {
        attrs = attrs || jade.attrs;
        escape = escape || jade.escape;
        rethrow = rethrow || jade.rethrow;
        merge = merge || jade.merge;
        var buf = [];
        with(locals || {}) {
            var interp;
            buf.push('<a id="prev" class="btn btn-large round2 btn-info pull-left"><i class="icon-arrow-left"></i></a><a id="next" class="btn btn-large round2 btn-info pull-right"><i class="icon-arrow-right"></i></a><div class="questionBlock"></div>');
        }
        return buf.join("");
    };
});
window.require.register("views/templates/vertex", function (exports, require, module) {
    module.exports = function anonymous(locals, attrs, escape, rethrow, merge) {
        attrs = attrs || jade.attrs;
        escape = escape || jade.escape;
        rethrow = rethrow || jade.rethrow;
        merge = merge || jade.merge;
        var buf = [];
        with(locals || {}) {
            var interp;
            buf.push('<span>' + escape((interp = name) == null ? '' : interp) + '</span>');
        }
        return buf.join("");
    };
});
window.require.register("views/templates/vertices", function (exports, require, module) {
    module.exports = function anonymous(locals, attrs, escape, rethrow, merge) {
        attrs = attrs || jade.attrs;
        escape = escape || jade.escape;
        rethrow = rethrow || jade.rethrow;
        merge = merge || jade.merge;
        var buf = [];
        with(locals || {}) {
            var interp;
        }
        return buf.join("");
    };
});
window.require.register("views/vertex_view", function (exports, require, module) {
    var View = require('./view');
    var template = require('./templates/vertex');

    module.exports = View.extend({
        className: 'vertex',
        template: template,

        initialize: function () {
            console.log('init vertexView');
            _.bindAll(this, 'render');
            this.model.bind('change', this.render);
            this.model.bind('edit', this.edit);
            this.model.bind('activate', this.activate);
            this.model.bind('deactivate', this.deactivate);
        },

        render: function () {
            var renderedContent = this.template(this.model.toJSON());
            console.log('render vertex');
            var self = this;

            // if (window.questionID != '51119351416b86696a000002'){
            // alert(window.question && _.contains(window.question.get('tags'), 'connect'));
            if(!(window.question && _.contains(window.question.get('tags'), 'connect'))) {
                //

                $(this.el)
                    .data('model', this.model)
                    .html(renderedContent)
                    .css({
                        top: this.model.get('y') + "px",
                        left: this.model.get('x') + "px"
                    }).draggable({
                        start: function () {
                            // console.log('0');
                            // window.vertices.store();
                        },
                        drag: function () {
                            // console.log('1');
                        },
                        stop: function () {
                            // console.log('2');
                        }
                    })
                    .hammer({
                        prevent_default: true,
                        drag: false,
                        tap: false,

                    }).popover({
                        placement: 'top',
                        title: function () {
                            return self.model.get('name');
                        },
                        trigger: 'manual',
                        html: true,
                        content: function () {

                            var $buttons = $('<div></div>');
                            $('<button class="btn edit" style="display: none">Rename</button>')
                                .data('model', self.model)
                                .data('view', self)
                                .appendTo($buttons);

                            // $('<button class="btn select" data-toggle="button">Answer</button>')
                            //     .data('model', self.model)
                            //     .data('view', self)
                            //     .appendTo($buttons);

                            var $group = $('<div class="btn-group" data-toggle="buttons-radio"></div>')
                                .appendTo($buttons);


                            var active = '';
                            var nactive = 'active';
                            if(self.model.get(window.questionID) == 1) {
                                active = 'active';
                                nactive = '';
                            }

                            $('<button class="btn select0 ' + nactive + '">Not an Answer</button>')
                                .data('model', self.model)
                                .data('view', self)
                                .appendTo($group);



                            $('<button class="btn select1 ' + active + '">An Answer</button>')
                                .data('model', self.model)
                                .data('view', self)
                                .appendTo($group);


                            /*<div class="btn-group" data-toggle="buttons-checkbox">
    <button type="button" class="btn btn-primary">Left</button>
    <button type="button" class="btn btn-primary">Middle</button>
    <button type="button" class="btn btn-primary">Right</button>
  </div>*/
                            return $buttons;
                        }
                    });
            } else {
                //CONN
                $(this.el)
                    .data('model', this.model)
                    .html(renderedContent)
                    .css({
                        top: this.model.get('y') + "px",
                        left: this.model.get('x') + "px"
                    }).draggable({
                        start: function () {
                            // console.log('0');
                            // window.vertices.store();
                        },
                        drag: function () {
                            // console.log('1');
                        },
                        stop: function () {
                            // console.log('2');
                        },
                        revert: "invalid",
                        helper: "clone"
                    })
                    .hammer({
                        prevent_default: true,
                        drag: false,
                        tap: false,

                    }).droppable({
                        accept: '.vertex',
                        hoverClass: "ui-state-active",
                        drop: function (event, ui) {
                            // self.model;
                            var model = ui.draggable.data('model');
                            var connections = model.get('connections');
                            if(connections == null) connections = [];

                            if(_.contains(connections, self.model.get('id'))) {

                                model.set('connections', _.without(connections, self.model.get('id')));
                                model.save();
                                reconnectNodes(true);

                            } else if(self.model.get('connections') != null && _.contains(self.model.get('connections'), model.get('id'))) {
                                self.model.set('connections', _.without(self.model.get('connections'), model.get('id')));
                                self.model.save();
                                reconnectNodes(true);

                            } else {
                                connections.push(self.model.get('id'));

                                // window.connectNodes(model, self.model);

                                model.set('connections', connections);
                                model.save();

                                reconnectNodes(true);
                            }

                        }
                    });

            }

            if(this.model.get(window.questionID) == 1) {
                $(this.el).addClass('answer');
            };
            if(this.model.get('deleted') == 1) {
                $(this.el).addClass('deleted');
            };

            return this;
        },

        events: {
            // 'hold': 'menu',
            // 'click': 'select',
            'drag': 'drag',
            // 'dblclick': 'edit',
            'doubletap': 'menu'

        },

        answer: function () {
            // if (window.questionID == '51119351416b86696a000002') return;
            if(window.question && _.contains(window.question.get('tags'), 'connect')) return;

            // this.collection.trigger('select', this.model);
            $(this.el).toggleClass('answer');
            // this.mode
            if($(this.el).hasClass('answer')) {
                this.model.set(window.questionID, 1, {
                    silent: true
                });
            } else {
                this.model.set(window.questionID, 0, {
                    silent: true
                });
            }
            this.model.save(null, {
                silent: true
            });
        },

        activate: function (event) {

            var view = $(event.currentTarget).data('view');
            var model = $(event.currentTarget).data('view').model;

            // console.log(view.el);

            $(view.el).addClass('answer');
            model.set(window.questionID, 1, {
                silent: true
            });
            model.save(null, {
                silent: true
            });
        },

        deactivate: function (event) {
            var view = $(event.currentTarget).data('view');
            var model = $(event.currentTarget).data('view').model;

            // console.log(view.el);

            $(view.el).removeClass('answer');
            model.set(window.questionID, 0, {
                silent: true
            });
            model.save(null, {
                silent: true
            });
        },

        select: function () {
            this.collection.trigger('select', this.model);
            $(this.el).toggleClass('selected');
        },

        drag: function (event, ui) {
            // if (window.questionID != '51119351416b86696a000002') {
            if(!(window.question && _.contains(window.question.get('tags'), 'connect'))) {
                this.model.set('x', ui.position.left, {
                    silent: true
                });
                this.model.set('y', ui.position.top, {
                    silent: true
                });

                reconnectNodes(true);
            }
            $(this.el).popover('hide');
        },

        delete: function () {
            console.log(this.model);
            // window.model = this.model;
            // vertices.collection.remove(this.model);
        },

        menu: function () {
            $('.vertices .vertex').not(this.el).popover('hide');
            $(this.el).popover('show');
        },

        edit: function (event) {

            console.log('edit', event);

            if(event) {
                // console.log(this.editThrottle, event.timeStamp);
                event.preventDefault();
                event.stopPropagation();

                if(this.editThrottle && this.editThrottle == event.timeStamp) return;

                this.editThrottle = event.timeStamp;
            }

            // if (window.questionID == '51119351416b86696a000002') return;
            if(window.question && _.contains(window.question.get('tags'), 'connect')) return;


            var pname = this.get('name');
            if(pname == '?') pname = '';

            var pname = prompt(this.get('proto') + ' ', pname);
            if(pname != null) {
                this.set('name', pname);
            }

            if(event) {
                var $el = $($(event.currentTarget).data('view').el); //.popover('destroy');
                $el.popover('hide');
            }

        }
    });

});
window.require.register("views/vertices_view", function (exports, require, module) {
    var View = require('./view');
    var template = require('./templates/vertices');

    var VertexView = require('views/vertex_view');

    module.exports = View.extend({
        className: 'vertices',
        template: template,

        initialize: function () {
            console.log('init verticesView');
            _.bindAll(this, 'render');
            this.collection.bind('reset', this.render);
            this.collection.bind('add', this.render);
            this.collection.bind('select', this.select);
        },

        render: function () {
            // console.log('vertices render');
            var $vertices,
                collection = this.collection;

            $(this.el).html(this.template({}));
            $vertices = $(this.el); //this.$('.vertices');



            $vertices.droppable({
                accept: '.vertex',
                hoverClass: "ui-state-active",
                drop: function (event, ui) {
                    // console.log(event, ui, ui.draggable.data('model'));
                    if(ui.draggable.parent().hasClass('vertices')) {
                        var model = ui.draggable.data('model');
                        model.save();


                    } else {
                        var model = collection.create({
                            name: ui.draggable.text(),
                            x: $(ui.helper).offset().left - $('.vertices').offset().left,
                            y: $(ui.helper).offset().top - $('.vertices').offset().top
                        });

                        model.set('created', window.questionID);
                        model.set(window.questionID, 1);
                        model.set('proto', model.get('name'));
                        model.set('qname', window.question.get('name'));

                        //increment cardinality of qname 
                        if(typeof window.YOU.get(window.question.get('name')) == 'undefined') {
                            window.YOU.set(window.question.get('name'), 1);
                        } else {
                            window.YOU.set(window.question.get('name'), parseInt(window.YOU.get(window.question.get('name'))) + 1);
                        }


                        model.trigger('edit');


                    }
                    // collection.reset(collection.models);
                    // collection.store();
                    reconnectNodes();

                    // draw
                    // this.ctx.fillStyle = "rgb(150,29,28)";

                }
            }).hammer({
                prevent_default: true,
                // drag: false
            });

            $('.question h1').droppable({
                accept: '.vertex',
                hoverClass: "ui-state-active",
                drop: function (event, ui) {
                    if(window.questionID == '51119351416b86696a000002') return;
                    // console.log(event, ui, ui.draggable.data('model'));
                    if(ui.draggable.parent().hasClass('vertices')) {
                        var model = ui.draggable.data('model');
                        model.set('deleted', 1);
                        ui.draggable.addClass('deleted');
                        model.save();

                        PUB({
                            action: 'delete',
                            id: model.get('id'),
                            name: model.get('name')
                        });

                    }
                    // collection.reset(collection.models);
                    collection.store();
                }
            });

            if(window.questionID != '51119351416b86696a000002') {
                $vertices.droppable("enable");
            } else {
                //CONN
                $vertices.droppable("disable");
            }


            var $canvas;

            function makeCanvas() {
                $canvas = $('canvas');

                if($canvas.size() == 0) {

                    $canvas = $('<canvas>')
                        .attr('width', $('#viewport').width())
                        .attr('height', '200px');


                    // $('#play-view').append($canvas);
                    $('body').append($canvas);

                    // $canvas = $('<canvas>')
                    // .attr('width', $vertices.width())
                    // .attr('height', $vertices.height());

                    // $vertices.append($canvas);

                    window.ctx = $canvas.get(0).getContext('2d');
                }
                
                // window.ctx = $canvas.get(0).getContext('2d');
                // if (typeof window.ctx == 'undefined') window.ctx = $canvas.get(0).getContext('2d');
                window.ctx.lineWidth = 1;

            }

            makeCanvas();

            window.connectNodes = function (from, to) {
                // window.ctx.closePath();

                window.ctx.lineWidth = 1;
                window.ctx.strokeStyle = "rgb(255, 0, 0)";
                window.ctx.beginPath();
                window.ctx.moveTo(from.get('x') + 41, from.get('y') + 41);
                window.ctx.lineTo(to.get('x') + 41, to.get('y') + 41);
                window.ctx.stroke();
                window.ctx.closePath();
            };

            window.clearCanvas = function () {
                console.log('clearCanvas');

                makeCanvas();

                window.ctx.fillStyle = "rgb(255, 255, 255)";
                // window.ctx.clearRect(0,0,parseInt($canvas.width()),parseInt($canvas.height()));
                window.ctx.fillRect(0, 0, parseInt($canvas.width()), parseInt($canvas.height()));

                window.ctx.lineWidth = .5;
                window.ctx.strokeStyle = "rgb(128, 128, 128)";
                
                /*
                window.ctx.beginPath();
                window.ctx.moveTo(0, 400);
                window.ctx.lineTo(parseInt($canvas.width()), 400);
                window.ctx.stroke();
                window.ctx.closePath();

                window.ctx.beginPath();
                window.ctx.moveTo(0, 250);
                window.ctx.lineTo(parseInt($canvas.width()), 250);
                window.ctx.stroke();
                window.ctx.closePath();

                window.ctx.beginPath();
                window.ctx.moveTo(0, 175);
                window.ctx.lineTo(parseInt($canvas.width()), 175);
                window.ctx.stroke();
                window.ctx.closePath();

                window.ctx.beginPath();
                window.ctx.moveTo(0, 125);
                window.ctx.lineTo(parseInt($canvas.width()), 125);
                window.ctx.stroke();
                window.ctx.closePath();
                
                */

                // window.ctx = null;
                // $('<canvas>').remove();

                // $canvas = $('<canvas>')
                //   .attr('width', $vertices.width())
                //   .attr('height', $vertices.height());

                // $vertices.append($canvas);

                // window.ctx = $canvas.get(0).getContext('2d');
                // window.ctx.lineWidth = 1;  
            }

            window.reconnectNodes = function (clear) {
                // window.ctx.clearRect(0,0,$canvas.width(),$canvas.height());
                // if (clear) 
                clearCanvas();

                // if (window.questionID != '51115011214cb6ad39000001') return;

                // console.log("connections");

                // setTimeout(function(){

                vertices.each(function (vertex) {
                    // console.log(vertex);

                    var connections = vertex.get('connections');
                    if(connections != null) {

                        for(i = 0; i < connections.length; i++) {
                            connectNodes(vertex, collection.get(connections[i]));
                        }
                    }
                });
                // }, 200);

            }
            //


            collection.each(function (vertex) {

                // if (vertex.get('name') == 'Empty') return;

                var view = new VertexView({
                    model: vertex,
                    collection: collection
                });
                $vertices.append(view.render().el);

                //
                // var connections = vertex.get('connections');
                // if (connections != null) {
                //   for (i = 0; i < connections.length; i++) {
                //     connectNodes(vertex, collection.get(connections[i]));
                //   }
                // } 
                //
            });

            $('#undo').click(function () {
                // collection.restore();
            });

            reconnectNodes(true);



            return this;
        },

        events: {
            // swipe: 'swipe',
            // drag: 'drag',
            // dragstart: 'dragstart',
            // dragend: 'dragend'
            'click .edit': 'edit',
            'click .popover-title': 'edit2',
            'click .select0': 'deactivate',
            'click .select1': 'activate'
        },

        activate: function (event) {
            $(event.currentTarget).data('model').trigger('activate', event);
        },

        deactivate: function (event) {
            $(event.currentTarget).data('model').trigger('deactivate', event);
        },

        edit2: function (event) {
            event.preventDefault();
            event.stopPropagation();
            console.log('edit2', event.currentTarget);
            $(event.currentTarget).parents('.popover').find('.edit').trigger('click');
        },

        edit: function (event) {
            event.preventDefault();
            event.stopPropagation();
            console.log('edit0', event.currentTarget);
            // console.log($(event.currentTarget).data('model'));
            $(event.currentTarget).data('model').trigger('edit', event);
        },

        select: function (selectedModel) {
            $('.vertices .selected').removeClass('selected');
        },

        swipe: function (e) {
            console.log(e);
        },

        dragstart: function (event) {
            // console.log(event); 
            // window._line = {};
            // if (event.direction) {
            //   this.ctx.strokeStyle = "rgb(255, 0, 0)";
            //   this.ctx.beginPath();
            //   this.ctx.moveTo(event.position.x, event.position.y);
            //   this._line.x = event.position.x;
            //   this._line.y = event.position.y;
            // }
        },

        dragend: function (event) {
            console.log(event);
            // if (event.direction) {
            //   this.ctx.closePath();

            //   this.ctx.strokeStyle = "rgb(0, 0, 0)";
            //   this.ctx.beginPath();
            //   this.ctx.moveTo(window._line.x, window._line.y);
            //   this.ctx.lineTo(window._line.x1, window._line.y1);
            //   this.ctx.stroke();
            //   this.ctx.closePath();
            // } 
        },

        drag: function (event) {
            if(event.direction) {
                // console.log(event); 
                // console.log(this.ctx);  



                // this.ctx.lineTo(event.position.x + event.distanceX, event.position.y + event.distanceY);
                // this.ctx.lineTo(event.position.x + 1, event.position.y + 1);
                // this.ctx.lineTo(event.position.x, event.position.y);
                // this.ctx.stroke();
                // this._line.x1 = event.position.x;
                // this._line.y1 = event.position.y;
            }

        }
    });

});
window.require.register("views/view", function (exports, require, module) {
    require('lib/view_helper');

    // Base class for all views.
    module.exports = Backbone.View.extend({
        initialize: function () {
            this.render = _.bind(this.render, this);
        },

        template: function () {},
        getRenderData: function () {},

        render: function () {
            this.$el.html(this.template(this.getRenderData()));
            this.afterRender();
            return this;
        },

        afterRender: function () {}
    });

});