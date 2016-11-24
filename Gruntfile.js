module.exports = function(grunt) {
    require('jit-grunt')(grunt);

    grunt.initConfig({

        concat: {
            options: {

            },
            dist: {
                src: ["js/modules/app/controllers/**/*.js"],
                dest: 'js/public/concat.js'
            }
        },
        uglify:{
            options:{
                manage: false
            },
            build: {
                src: "js/public/concat.js",
                dest: "js/public/controllers.min.js"
            }
        },

        less: {
            development: {
                options: {
                    compress: true,
                    yuicompress: true,
                    optimization: 2
                },
                files: {
                    "css/styles.css": "css/styles.less", // destination file and source file
                    "css/responsive.css": "css/responsive.less" // destination file and source file
                }
            }
        },
        watch: {
            styles: {
                files: ['css/**/*.less'], // which files to watch
                tasks: ['less'],
                options: {
                    nospawn: true
                }
            },
            scripts:{
                files: ['js/modules/app/**/*.js'],
                tasks: ['concat', 'uglify:build'],
                options: {
                    atBegin: true
                }
            }

        }
    });


    grunt.registerTask('default', ['less', 'watch']);
    grunt.registerTask('default', ['concat', 'watch']);
    grunt.registerTask('default', ['uglify', 'watch']);

};