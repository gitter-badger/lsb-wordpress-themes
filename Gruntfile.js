'use strict';
module.exports = function(grunt) {
  // Load all tasks
  require('load-grunt-tasks')(grunt);
  // Show elapsed time
  require('time-grunt')(grunt);

  var basePrefix = 'wp-content/themes/lsb-base-theme/';
  var mainPrefix = 'wp-content/themes/lsb-lesersokerbok.no-theme/';
  var boksokPrefix = 'wp-content/themes/lsb-boksok.no-theme/';

  var jsBaseFileList = [
    basePrefix + 'assets/vendor/bootstrap/js/transition.js',
    basePrefix + 'assets/vendor/bootstrap/js/alert.js',
    basePrefix + 'assets/vendor/bootstrap/js/button.js',
    basePrefix + 'assets/vendor/bootstrap/js/carousel.js',
    basePrefix + 'assets/vendor/bootstrap/js/collapse.js',
    basePrefix + 'assets/vendor/bootstrap/js/dropdown.js',
    basePrefix + 'assets/vendor/bootstrap/js/modal.js',
    basePrefix + 'assets/vendor/bootstrap/js/tooltip.js',
    basePrefix + 'assets/vendor/bootstrap/js/popover.js',
    basePrefix + 'assets/vendor/bootstrap/js/scrollspy.js',
    basePrefix + 'assets/vendor/bootstrap/js/tab.js',
    basePrefix + 'assets/vendor/bootstrap/js/affix.js',
    basePrefix + 'assets/js/plugins/*.js',
    basePrefix + 'assets/js/_*.js'
  ];

  var jsMainFileList = jsBaseFileList.slice(0);
  jsMainFileList.push(mainPrefix + 'assets/js/_*.js');

  var jsBoksokFileList = jsBaseFileList.slice(0);
  jsBoksokFileList.push(boksokPrefix + 'assets/js/_*.js');

  var lessDevBaseFiles = {};
  lessDevBaseFiles[basePrefix + 'assets/css/main.css'] = [ basePrefix + 'assets/less/main.less'];

  var lessDevMainFiles = {};
  lessDevMainFiles[mainPrefix + 'assets/css/main.css'] = [ mainPrefix + 'assets/less/main.less'];

  var lessDevBoksokFiles = {};
  lessDevBoksokFiles[boksokPrefix + 'assets/css/main.css'] = [ boksokPrefix + 'assets/less/main.less'];

  var lessBuildFiles = {};
  lessBuildFiles[basePrefix + 'assets/css/main.min.css'] = [ basePrefix + 'assets/less/main.less'];
  lessBuildFiles[mainPrefix + 'assets/css/main.min.css'] = [ mainPrefix + 'assets/less/main.less'];
  lessBuildFiles[boksokPrefix + 'assets/css/main.min.css'] = [ boksokPrefix + 'assets/less/main.less'];

  var uglifyFiles = {};
  uglifyFiles[basePrefix + 'assets/js/scripts.min.js'] = [jsBaseFileList];
  uglifyFiles[mainPrefix + 'assets/js/scripts.min.js'] = [jsMainFileList];
  uglifyFiles[boksokPrefix + 'assets/js/scripts.min.js'] = [jsBoksokFileList];

  grunt.initConfig({
    jshint: {
      options: {
        jshintrc: '.jshintrc'
      },
      all: [
        'Gruntfile.js',
        basePrefix + 'assets/js/*.js',
        '!' + basePrefix + 'assets/js/scripts.js',
        '!' + basePrefix + 'assets/**/*.min.*',
        mainPrefix + 'assets/js/*.js',
        '!' + mainPrefix + 'assets/js/scripts.js',
        '!' + mainPrefix + 'assets/**/*.min.*',
        boksokPrefix + 'assets/js/*.js',
        '!' + boksokPrefix + 'assets/js/scripts.js',
        '!' + boksokPrefix + 'assets/**/*.min.*'
      ]
    },
    less: {
      devBase: {
        files: lessDevBaseFiles,
        options: {
          compress: false,
          // LESS source map
          // To enable, set sourceMap to true and update sourceMapRootpath based on your install
          sourceMap: true,
          sourceMapFilename: basePrefix + 'assets/css/main.css.map'
          //sourceMapRootpath: basePrefix + 'assets/css/'
        }
      },
      devMain: {
        files: lessDevMainFiles,
        options: {
          compress: false,
          // LESS source map
          // To enable, set sourceMap to true and update sourceMapRootpath based on your install
          sourceMap: true,
          sourceMapFilename: mainPrefix + 'assets/css/main.css.map'
          //sourceMapRootpath: boksokPrefix + 'assets/css/'
        }
      },
      devBoksok: {
        files: lessDevBoksokFiles,
        options: {
          compress: false,
          // LESS source map
          // To enable, set sourceMap to true and update sourceMapRootpath based on your install
          sourceMap: true,
          sourceMapFilename: boksokPrefix + 'assets/css/main.css.map'
          //sourceMapRootpath: boksokPrefix + 'assets/css/'
        }
      },
      buildBase: {
        files: lessBuildFiles,
        options: {
          compress: true
        }
      },
      buildMain: {
        files: lessBuildFiles,
        options: {
          compress: true
        }
      },
      buildBoksok: {
        files: lessBuildFiles,
        options: {
          compress: true
        }
      }
    },
    concat: {
      options: {
        separator: ';',
      },
      base: {
        src: jsBaseFileList,
        dest: basePrefix + 'assets/js/scripts.js',
      },
      main: {
        src: jsMainFileList,
        dest: mainPrefix + 'assets/js/scripts.js',
      },
      boksok: {
        src: jsBoksokFileList,
        dest: boksokPrefix + 'assets/js/scripts.js',
      }
    },
    uglify: {
      dist: {
        files: uglifyFiles
      }
    },
    autoprefixer: {
      options: {
        browsers: ['last 2 versions', 'ie 8', 'ie 9', 'android 2.3', 'android 4', 'opera 12']
      },
      devBase: {
        options: {
          map: {
            prev: basePrefix + 'assets/css/'
          }
        },
        src: basePrefix + 'assets/css/main.css'
      },
      devMain: {
        options: {
          map: {
            prev: mainPrefix + 'assets/css/'
          }
        },
        src: mainPrefix + 'assets/css/main.css'
      },
      devBoksok: {
        options: {
          map: {
            prev: boksokPrefix + 'assets/css/'
          }
        },
        src: boksokPrefix + 'assets/css/main.css'
      },
      buildBase: {
        src: basePrefix + 'assets/css/main.min.css'
      },
      buildMain: {
        src: mainPrefix + 'assets/css/main.min.css'
      },
      buildBoksok: {
        src: boksokPrefix + 'assets/css/main.min.css'
      }
    },
    modernizr: {
      base: {
        devFile: basePrefix + 'assets/vendor/modernizr/modernizr.js',
        outputFile: basePrefix + 'assets/js/vendor/modernizr.min.js',
        files: {
          'src': [
            [basePrefix + 'assets/js/scripts.min.js'],
            [basePrefix + 'assets/css/main.min.css']
          ]
        },
        uglify: true,
        parseFiles: true
      },
      main: {
        devFile: basePrefix + 'assets/vendor/modernizr/modernizr.js',
        outputFile: mainPrefix + 'assets/js/vendor/modernizr.min.js',
        files: {
          'src': [
            [mainPrefix + 'assets/js/scripts.min.js'],
            [mainPrefix + 'assets/css/main.min.css']
          ]
        },
        uglify: true,
        parseFiles: true
      },
      boksok: {
        devFile: basePrefix + 'assets/vendor/modernizr/modernizr.js',
        outputFile: boksokPrefix + 'assets/js/vendor/modernizr.min.js',
        files: {
          'src': [
            [boksokPrefix + 'assets/js/scripts.min.js'],
            [boksokPrefix + 'assets/css/main.min.css']
          ]
        },
        uglify: true,
        parseFiles: true
      }
    },
    version: {
      base: {
        options: {
          format: true,
          length: 32,
          manifest: basePrefix + 'assets/manifest.json',
          querystring: {
            style: 'roots_css',
            script: 'roots_js'
          }
        },
        files: {
         'wp-content/themes/lsb-base-theme/lib/scripts.php': basePrefix + 'assets/{css,js}/{main,scripts}.min.{css,js}'
        }
      },
      main: {
        options: {
          format: true,
          length: 32,
          manifest: basePrefix + 'assets/manifest.json',
          querystring: {
            style: 'roots_child_css',
            script: 'roots_child_js'
          }
        },
        files: {
         'wp-content/themes/lsb-base-theme/lib/scripts.php': mainPrefix + 'assets/{css,js}/{main,scripts}.min.{css,js}'
        }
      },
      boksok: {
        options: {
          format: true,
          length: 32,
          manifest: basePrefix + 'assets/manifest.json',
          querystring: {
            style: 'roots_child_css',
            script: 'roots_child_js'
          }
        },
        files: {
         'wp-content/themes/lsb-base-theme/lib/scripts.php': boksokPrefix + 'assets/{css,js}/{main,scripts}.min.{css,js}'
        }
      }
    },
    watch: {
      less: {
        files: [
          basePrefix + 'assets/less/*.less',
          basePrefix + 'assets/less/**/*.less',
          mainPrefix + 'assets/less/*.less',
          mainPrefix + 'assets/less/**/*.less',
          boksokPrefix + 'assets/less/*.less',
          boksokPrefix + 'assets/less/**/*.less'
        ],
        tasks: ['less:devBase', 'less:devMain', 'less:devBoksok', 'autoprefixer:devBase', 'autoprefixer:devMain', 'autoprefixer:devBoksok']
      },
      js: {
        files: [
          jsBaseFileList,
          '<%= jshint.all %>'
        ],
        tasks: ['jshint', 'concat']
      },
      livereload: {
        // Browser live reloading
        // https://github.com/gruntjs/grunt-contrib-watch#live-reloading
        options: {
          livereload: false
        },
        files: [
          basePrefix + 'assets/css/main.css',
          basePrefix + 'assets/js/scripts.js',
          basePrefix + 'templates/*.php',
          basePrefix + '*.php',
          mainPrefix + 'assets/css/main.css',
          mainPrefix + 'assets/js/scripts.js',
          mainPrefix + 'templates/*.php',
          mainPrefix + '*.php',
          boksokPrefix + 'assets/css/main.css',
          boksokPrefix + 'assets/js/scripts.js',
          boksokPrefix + 'templates/*.php',
          boksokPrefix + '*.php'
        ]
      }
    }
  });

  // Register tasks
  grunt.registerTask('default', [
    'dev'
  ]);
  grunt.registerTask('dev', [
    'jshint',
    'less:devBase',
    'less:devMain',
    'less:devBoksok',
    'autoprefixer:devBase',
    'autoprefixer:devMain',
    'autoprefixer:devBoksok',
    'concat:base',
    'concat:main',
    'concat:boksok'
  ]);
  grunt.registerTask('dev-base', [
    'jshint',
    'less:devBase',
    'autoprefixer:devBase',
    'concat:base',
  ]);
  grunt.registerTask('dev-main', [
    'jshint',
    'less:devMain',
    'autoprefixer:devMain',
    'concat:main'
  ]);
  grunt.registerTask('dev-bok', [
    'jshint',
    'less:devBoksok',
    'autoprefixer:devBoksok',
    'concat:boksok'
  ]);
  grunt.registerTask('build', [
    'jshint',
    'less:buildBase',
    'less:buildMain',
    'less:buildBoksok',
    'autoprefixer:buildBase',
    'autoprefixer:buildMain',
    'autoprefixer:buildBoksok',
    'uglify',
    'modernizr:base',
    'modernizr:main',
    'modernizr:boksok',
    'version'
  ]);
};
