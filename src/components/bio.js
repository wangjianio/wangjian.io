import React from 'react';
import { useStaticQuery, graphql } from 'gatsby';

import { rhythm } from '../utils/typography';

export default function Bio(params) {
  const data = useStaticQuery(graphql`
    query BioQuery {
      avatar: file(absolutePath: { regex: "/profile-pic.jpg/" }) {
        childImageSharp {
          fixed(width: 50, height: 50) {
            ...GatsbyImageSharpFixed
          }
        }
      }
      site {
        siteMetadata {
          author
          social {
            twitter
          }
        }
      }
    }
  `);

  const { author, social } = data.site.siteMetadata
  return (
    <div
      style={{
        display: `flex`,
        marginBottom: rhythm(2.5),
      }}
    >
      <p>
        Written by <strong>{author}</strong> who lives and works in China building useful things.
        {` `}
        <a href={`https://twitter.com/${social.twitter}`}>
          You can follow him on Twitter
        </a>
      </p>
    </div>
  )
}


