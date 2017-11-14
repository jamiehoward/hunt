# Specification

## Entities
- user
- campaignUser
    - campaignCode
- campaign
    - title
    - introduction
    - resolution_id
    - hint_count
- campaignClue
    - campaign_id
    - clue_id
- response
    - clue_id
    - content_id
    - user_id
    - passed
- clue
    - label
    - answer
- hint
    - clue_id
    - content
- clueHintUser
    - clue_id
    - hint_id
    - user_id
- resolution
    - content

## Workflow
1. Campaign is created.
2. Clues are created.
3. Clues are added to the campaign.
4. Users are created.
5. Users are added to the campaign.

## Recipient workflow
1. User is given a campaign code and website link.
2. User visits the link and is prompted to enter campaign code.
3. User enters given code
4. User is logged into pre-created account and begin their first campaign.
5. Campaign introduction text is displayed.
6. User clicks "begin" and is sent to first clue.
7. User clicks "hint" to cash in on a hint
8. User enters the correct answer and advances to next clue.
