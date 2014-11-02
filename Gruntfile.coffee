module.exports = (grunt) ->
	grunt.initConfig

		options:
			app: 'public/assets'
			dist: 'public/assets-dist'
			layouts: 'app/views/layouts'

		bowercopy:
			bootstrap:
				src: 'bootstrap/dist/*'
				dest: '<%= options.app %>/library/bootstrap'
			js:
				options:
					destPrefix: '<%= options.app %>/library/js'
				files:
					'jquery.min.js': 'jquery/dist/jquery.min.js'
			ng:
				options:
					destPrefix: '<%= options.app %>/library/ng'
				files:
					'angular.min.js': 'angular/angular.min.js'
					'angular-resource.min.js': 'angular-resource/angular-resource.min.js'
					'angular-route.min.js': 'angular-route/angular-route.min.js'
					'angular-ui-router.min.js': 'angular-ui-router/release/angular-ui-router.min.js'

	grunt.loadNpmTasks('grunt-bowercopy')
	grunt.registerTask('default', ['bowercopy'])

