ARG CI_COMMIT_SHORT_SHA

FROM 290707654612.dkr.ecr.eu-central-1.amazonaws.com/gitlab-engine-pipeline-image:app_${CI_COMMIT_SHORT_SHA}

ENTRYPOINT ["vendor/bin/behat"]
CMD ["-c behat.yml", "features/Smoke.feature"]