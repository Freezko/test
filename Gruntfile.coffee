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

    grunt.loadNpmTasks('grunt-bowercopy')
    grunt.registerTask('default', ['bowercopy'])

