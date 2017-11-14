# Specification

## Entities
- user
- campaignUser
    - campaignCode
- campaign
    - title
    - resolution_id
- campaignClue
- response
    - clue_id
    - content_id
- clue
    - label
    - answer
- hint
    - clue_id
    - content
- resolution
    - content

## Workflow
1. Campaign is created.
2. Clues are created.
3. Clues are added to the campaign.
4. Users are created.
5. Users are added to the campaign.