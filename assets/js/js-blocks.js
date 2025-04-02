( function () {
    var registerBlockType = wp.blocks.registerBlockType;
    var createElement = wp.element.createElement;
    var MediaUpload = wp.blockEditor.MediaUpload;

    registerBlockType( 'jaeins-custom-blocks/impression-hero-block', {
        title: "Hero Section",
        icon: 'format-image',
        category: 'impression',
        attributes: {
            image: {
                type: 'string',
                source: 'attribute',
                selector: 'img',
                attribute: 'src',
                default: ''
            },
            title: {
                type: 'string',
                default: 'Title'
            },
            subtitle: {
                type: 'string',
                default: 'Subtitle'
            }
        },
        edit: function ( props ) {
            var attributes = props.attributes;

            function onImageChange( newImage ) {
                return props.setAttributes( { image: newImage } );
            }

            function onTitleChange( newTitle ) {
                props.setAttributes( { title: newTitle } );
            }

            function onSubtitleChange( newSubtitle ) {
                props.setAttributes( { subtitle: newSubtitle } );
            }

            return createElement(
                'div',
                { className: 'hero--section' },
                createElement(
                    'div',
                    {},
                    createElement( MediaUpload, {
                        onSelect: onImageChange,
                        type: 'image',
                        value: attributes.image,
                        render: function ( _ref ) {
                            var open = _ref.open;
                            return createElement(
                                'div',
                                { className: 'image-container' },
                                attributes.image ? wp.element.createElement( 'img', { src: attributes.image.url } ) : '',
                                wp.element.createElement( wp.components.Button, {
                                    className: attributes.image ? 'change-image-button' : 'upload-button',
                                    onClick: open,
                                }, wp.element.createElement( 'img', { src: attributes.image.url } ) ? 'Change Image' : 'Upload Image' )
                            );
                        }
                    } ),
                ),
                createElement(
                    "div",
                    {
                        class: "foo"
                    },
                    createElement( 'input', {
                        type: 'text',
                        className: 'title-field',
                        placeholder: "Title",
                        value: attributes.title,
                        onChange: function ( event ) {
                            onTitleChange( event.target.value );
                        }
                    } ),
                    createElement( 'input', {
                        type: 'text',
                        className: 'subtitle-field',
                        placeholder: "Lorem ipsum",
                        value: attributes.subtitle,
                        onChange: function ( event ) {
                            onSubtitleChange( event.target.value );
                        }
                    } )
                )
            );
        },
        save: function ( props ) {
            console.log(props);
            return wp.element.createElement(
                "div",
                {
                    class: "hero--section"
                },
                wp.element.createElement(
                    "div",
                    {
                        class: "section-col image--col"
                    },
                    wp.element.createElement( 'img', { src: props.attributes.image.url } ),
                ),
                wp.element.createElement(
                    "div",
                    {
                        class: "section-col text--col"
                    },
                    wp.element.createElement( "h2", null, props.attributes.title ),
                    wp.element.createElement(
                        "p",
                        {
                            class: "subtitle"
                        },
                        props.attributes.subtitle
                    )
                )
            );



        }
    } );
} )(
    window.wp.blocks,
    window.wp.editor,
    window.wp.components,
    window.wp.i18n,
    window.wp.element
);
