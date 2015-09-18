module.exports = function(grunt) {

	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),

	
		watch: {
			
			css_styles: {
				files: 'sass/styles/*.scss',
				tasks: 'dist-css-main',
				options: {
					livereload: true,
				}
			},
		},

	
		sass: {
			main_css: {
				options: {
					style: 'expanded'
				},
				files: {
					'sass/main.css': 'sass/styles.scss'
				}
			},
		},

		autoprefixer: {
			options: {
				browsers: ['last 2 version', 'ie 8', 'ie 9']
			},
			main: {
				src: 'sass/main.css'
			}
		},

		cssmin: {
			main: {
				expand: true,
				cwd: 'sass',
				src: ['main.css'],
				dest: 'sass',
				ext: '.min.css'
			},
		},

	});

	// These plugins provide necessary tasks
	grunt.loadNpmTasks('grunt-autoprefixer');
	grunt.loadNpmTasks('grunt-contrib-clean');
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-copy');
	grunt.loadNpmTasks('grunt-contrib-csslint');
	grunt.loadNpmTasks('grunt-contrib-cssmin');
	grunt.loadNpmTasks('grunt-contrib-jshint');
	grunt.loadNpmTasks('grunt-contrib-sass');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-auto-install');


	// CSS distribution task
	grunt.registerTask('dist-css', 'dist-css-main');

	// CSS Main distribution task
	grunt.registerTask('dist-css-main', ['sass:main_css', 'autoprefixer:main', 'cssmin:main']);

	// Full distribution task
	grunt.registerTask('dist', 'dist-css');

	// Default task
	grunt.registerTask('default', ['dist', 'watch']);

};
